<?php

namespace App\Livewire\Frontend;

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class BlogDetailPage extends Component
{
    public Blog $post;

    public function mount(string $slug): void
    {
        $this->post = Blog::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
    }

    public function render()
    {
        $related = Blog::with(['category', 'author'])
            ->where('status', 'published')
            ->where('id', '!=', $this->post->id)
            ->where(fn ($q) => $q
                ->where('blog_category_id', $this->post->blog_category_id)
                ->orWhere('user_id', $this->post->user_id)
            )
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('livewire.frontend.blog-detail-page', compact('related'))
            ->title($this->post->title);
    }
}
