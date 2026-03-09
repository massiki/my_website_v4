<?php

namespace App\Livewire\Frontend;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Services')]
class ServicesPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.services-page', [
            'services' => Service::orderBy('sort_order')->get(),
        ]);
    }
}
