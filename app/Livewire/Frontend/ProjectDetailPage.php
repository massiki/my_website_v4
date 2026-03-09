<?php

namespace App\Livewire\Frontend;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class ProjectDetailPage extends Component
{
    public Project $project;

    public function mount(string $slug): void
    {
        $this->project = Project::with(['category', 'technologies'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.project-detail-page')
            ->title($this->project->title);
    }
}
