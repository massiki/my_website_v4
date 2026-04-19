<?php

namespace App\Livewire\Admin;

use App\Models\Technology;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Manage Technogies')]
class ManageTechnologies extends Component
{
  use WithPagination;

  public bool $showTechnologyModal = false;
  public ?int $editTechId = null;

  public $technologyName = '';

  public function create(): void
  {
    $this->reset(['editTechId', 'technologyName']);
    $this->showTechnologyModal = true;
  }

  public function edit(Technology $technology): void
  {
    $this->editTechId = $technology->id;
    $this->technologyName = $technology->name;
    $this->showTechnologyModal = true;
  }

  public function save(): void
  {
    $validated = $this->validate([
      'technologyName' => 'required|string|max:255',
    ]);

    $baseSlug = Str::slug($validated['technologyName']);
    $slug = $baseSlug;
    $count = 1;
    while (Technology::where('slug', $slug)->exists()) {
      $slug = $baseSlug . '-' . $count;
      $count++;
    }

    Technology::updateOrCreate(
      ['id' => $this->editTechId],
      [
        'name' => $validated['technologyName'],
        'slug' => $slug,
      ]
    );

    $this->showTechnologyModal = false;
    session()->flash('success', $this->editTechId ? 'Technology updated!' : 'Technology created! ');
    $this->reset(['technologyName', 'editTechId']);
  }

  public function delete(Technology $technology): void
  {
    $technology->delete();
    session()->flash('success', 'Technology deleted!');
  }

  public function render()
  {
    return view('livewire.admin.manage-technologies', [
      'technologies' => Technology::latest()->paginate(10)
    ]);
  }
}
