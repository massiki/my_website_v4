<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Create Blog')]
class CreateBlog extends Component
{
    use WithFileUploads;

    public $title = '';
    public $slug = '';
    public $content = '';
    public $meta_description = '';
    public $status = 'draft';
    public $blog_category_id = '';
    public $thumbnail;
    public $published_at = '';
    public $thumbnailPreview = null;

    public function updatedTitle(string $value)
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $count = 1;

        while (Blog::where('slug', $slug)->exists()) {
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
    }

    public function removeThumbnail()
    {
        $this->thumbnail = null;
        $this->thumbnailPreview = null;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'content' => 'required|string',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'thumbnail' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $thumbnailPath = null;
        if ($this->thumbnail) {
            $thumbnailPath = $this->thumbnail->store('blog-thumbnails', 'public');
        }

        Blog::create([
            'user_id' => Auth::id(),
            'blog_category_id' => $this->blog_category_id ?: null,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'meta_description' => $this->meta_description,
            'status' => $this->status,
            'thumbnail' => $thumbnailPath,
            'published_at' => $this->status === 'published' ? now() : null,
        ]);

        session()->flash('success', 'Blog post created!');
        return $this->redirect(route('admin.blogs'), navigate: true);
    }

    public function render()
    {
        $categories = BlogCategory::orderBy('name')->get(['id', 'name']);
        return view('livewire.admin.blog.create', compact('categories'));
    }
}
