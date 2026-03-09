<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use App\Models\Project;
use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalProjects'  => Project::count(),
            'totalServices'  => Service::count(),
            'totalMessages'  => Message::count(),
            'unreadMessages' => Message::unread()->count(),
            'recentMessages' => Message::latest()->take(5)->get(),
            'featuredProjects' => Project::where('is_featured', true)->count(),
        ]);
    }
}
