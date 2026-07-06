<?php

namespace App\Livewire\Admin;

use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Manage Blog Categories')]
class ManageBlogCategories extends Component
{
  use WithPagination;

  public bool $showCategoryModal = false;
  public ?int $editCategoryId = null;
  public string $categoryName = '';

  public function create(): void
  {
    $this->reset(['editCategoryId', 'categoryName']);
    $this->showCategoryModal = true;
  }

  public function edit(BlogCategory $category): void
  {
    $this->editCategoryId = $category->id;
    $this->categoryName = $category->name;
    $this->showCategoryModal = true;
  }

  public function save(): void
  {
    $validated = $this->validate([
      'categoryName' => 'required|string|max:255',
    ]);

    $baseSlug = Str::slug($validated['categoryName']);
    $slug = $baseSlug;
    $count = 1;

    // Only enforce unique slug for create or when changing name
    if ($this->editCategoryId) {
      $existing = BlogCategory::find($this->editCategoryId);
      if ($existing && $existing->name === $validated['categoryName']) {
        $slug = $existing->slug;
      } else {
        while (BlogCategory::where('slug', $slug)
          ->when($this->editCategoryId, fn($q) => $q->where('id', '!=', $this->editCategoryId))
          ->exists()
        ) {
          $slug = $baseSlug . '-' . $count;
          $count++;
        }
      }
    } else {
      while (BlogCategory::where('slug', $slug)->exists()) {
        $slug = $baseSlug . '-' . $count;
        $count++;
      }
    }

    BlogCategory::updateOrCreate(
      ['id' => $this->editCategoryId],
      [
        'name' => $validated['categoryName'],
        'slug' => $slug,
      ]
    );

    $this->showCategoryModal = false;
    session()->flash('success', $this->editCategoryId ? 'Blog category updated!' : 'Blog category created!');
    $this->reset(['categoryName', 'editCategoryId']);
  }

  public function delete(BlogCategory $category): void
  {
    $category->delete();
    session()->flash('success', 'Blog category deleted!');
  }

  public function render()
  {
    $categories = BlogCategory::latest('id')->paginate(10, ['id', 'name', 'slug']);
    return view('admin.manage-blog-categories', compact('categories'));
  }
}
