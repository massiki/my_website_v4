<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Edit Blog')]
class EditBlog extends Component
{
    use WithFileUploads;

    public Blog $blog;
    public $title = '';
    public $slug = '';
    public $content = '';
    public $meta_description = '';
    public $status = 'draft';
    public $blog_category_id = '';
    public $thumbnail;
    public $published_at = '';
    public $thumbnailPreview = null;
    public $existingThumbnail = null;

    public function mount(Blog $blog)
    {
        if (!$blog->id) {
            abort(404);
        }

        $this->blog = $blog;
        $this->title = $blog->title;
        $this->slug = $blog->slug;
        $this->content = $blog->content;
        $this->meta_description = $blog->meta_description;
        $this->status = $blog->status;
        $this->blog_category_id = (string) $blog->blog_category_id;
        $this->published_at = $blog->published_at?->format('Y-m-d\TH:i');
        $this->existingThumbnail = $blog->thumbnail;
    }

    public function updatedTitle(string $value)
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $count = 1;

        while (Blog::where('slug', $slug)->where('id', '!=', $this->blog->id)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }
        $this->slug = $slug;
    }

    public function updatedThumbnail()
    {
        $this->validateOnly('thumbnail', [
            'thumbnail' => 'nullable|image|max:1024',
        ]);
        $this->thumbnailPreview = $this->thumbnail->temporaryUrl();
        $this->existingThumbnail = null;
    }

    public function removeThumbnail()
    {
        $this->thumbnail = null;
        $this->thumbnailPreview = null;
        $this->existingThumbnail = null;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $this->blog->id,
            'content' => 'required|string',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'thumbnail' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $thumbnailPath = $this->existingThumbnail;

        if ($this->thumbnail) {
            if ($this->blog->thumbnail) {
                Storage::disk('public')->delete($this->blog->thumbnail);
            }
            $thumbnailPath = $this->thumbnail->store('blog-thumbnails', 'public');
        } elseif ($this->existingThumbnail === null && $this->blog->thumbnail) {
            Storage::disk('public')->delete($this->blog->thumbnail);
            $thumbnailPath = null;
        }

        $this->blog->update([
            'blog_category_id' => $this->blog_category_id ?: null,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'meta_description' => $this->meta_description,
            'status' => $this->status,
            'thumbnail' => $thumbnailPath,
            'published_at' => $this->status === 'published' ? now() : null,
        ]);

        session()->flash('success', 'Blog post updated!');
        return $this->redirect(route('admin.blogs'), navigate: true);
    }

    public function render()
    {
        $categories = BlogCategory::orderBy('name')->get(['id', 'name']);
        return view('livewire.admin.blog.edit', compact('categories'));
    }
}
