<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Manage Categories')]
class ManageCategories extends Component
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

  public function edit(Category $category): void
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
    while (Category::where('slug', $slug)->exists()) {
      $slug = $baseSlug . '-' . $count;
      $count++;
    }

    Category::updateOrCreate(
      ['id' => $this->editCategoryId],
      [
        'name' => $validated['categoryName'],
        'slug' => $slug,
      ]
    );

    $this->showCategoryModal = false;
    session()->flash('success', $this->editCategoryId ? 'Category updated!' : 'Category created! ');
    $this->reset(['categoryName', 'editCategoryId']);
  }

  public function delete(Category $categories): void
  {
    $categories->delete();
    session()->flash('success', 'Cateegory deleted!');
  }

  public function render()
  {
    $categories = Category::latest('id')->paginate(10, ['id', 'name', 'slug']);
    return view('admin.manage-categories', compact('categories'));
  }
}
