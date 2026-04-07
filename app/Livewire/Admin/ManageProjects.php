<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Manage Projects')]
class ManageProjects extends Component
{
    use WithPagination, WithFileUploads;

    public bool $showModal = false;
    public ?int $editingId = null;
    public string $title = '';
    public string $short_description = '';
    public string $description = '';
    public ?int $category_id = null;
    public array $selectedTechs = [];
    public string $demo_url = '';
    public string $github_url = '';
    public bool $is_featured = false;
    public int $sort_order = 0;
    public $thumbnail;
    public string $search = '';

    protected function rules(): array
    {
        return [
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'category_id'       => 'required|exists:categories,id',
            'thumbnail'         => 'nullable|image|max:2048',
        ];
    }

    public function create(): void
    {
        $this->reset(['editingId', 'title', 'short_description', 'description', 'category_id', 'selectedTechs', 'demo_url', 'github_url', 'is_featured', 'sort_order', 'thumbnail']);
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $project = Project::with('technologies')->findOrFail($id);
        $this->editingId = $project->id;
        $this->title = $project->title;
        $this->short_description = $project->short_description;
        $this->description = $project->description ?? '';
        $this->category_id = $project->category_id;
        $this->selectedTechs = $project->technologies->pluck('id')->toArray();
        $this->demo_url = $project->demo_url ?? '';
        $this->github_url = $project->github_url ?? '';
        $this->is_featured = $project->is_featured;
        $this->sort_order = $project->sort_order;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();
        $data = [
            'title'             => $this->title,
            'slug'              => Str::slug($this->title),
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'category_id'       => $this->category_id,
            'demo_url'          => $this->demo_url ?: null,
            'github_url'        => $this->github_url ?: null,
            'is_featured'       => $this->is_featured,
            'sort_order'        => $this->sort_order,
        ];

        if ($this->thumbnail) {
            $data['thumbnail'] = $this->thumbnail->store('projects', 'public');
        }

        $project = Project::updateOrCreate(['id' => $this->editingId], $data);
        $project->technologies()->sync($this->selectedTechs);

        $this->showModal = false;
        session()->flash('success', $this->editingId ? 'Project updated!' : 'Project created!');
        $this->reset(['editingId', 'title', 'short_description', 'description', 'category_id', 'selectedTechs', 'demo_url', 'github_url', 'is_featured', 'sort_order', 'thumbnail']);
    }

    public function delete(int $id): void
    {
        Project::findOrFail($id)->delete();
        session()->flash('success', 'Project deleted!');
    }

    public function toggleFeatured(int $id): void
    {
        $project = Project::findOrFail($id);
        $project->update(['is_featured' => !$project->is_featured]);
    }

    public function render()
    {
        $query = Project::with(['category', 'technologies']);
        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%");
        }
        return view('livewire.admin.manage-projects', [
            'projects'     => $query->orderBy('sort_order')->paginate(10),
            'categories'   => Category::all(),
            'technologies' => Technology::all(),
        ]);
    }
}
