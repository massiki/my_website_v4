<?php

namespace App\Livewire\Frontend;

use App\Models\Blog;
use App\Models\BlogCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.guest')]
#[Title('Blog')]
class BlogPage extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $category = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function filterCategory(string $slug): void
    {
        $this->category = $this->category === $slug ? '' : $slug;
        $this->resetPage();
    }

    public function render()
    {
        $query = Blog::with(['category', 'author'])
            ->where('status', 'published');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('meta_description', 'like', "%{$this->search}%");
            });
        }

        if ($this->category) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $this->category));
        }

        return view('livewire.frontend.blog-page', [
            'blogs'      => $query->latest('published_at')->paginate(9),
            'categories' => BlogCategory::withCount(['blogs' => fn ($q) => $q->where('status', 'published')])->get(),
        ]);
    }
}
