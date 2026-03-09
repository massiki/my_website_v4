<?php

namespace App\Livewire\Frontend;

use App\Models\HomeContent;
use App\Models\Project;
use App\Models\Service;
use App\Models\Technology;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Home')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.frontend.home-page', [
            'heroName'     => HomeContent::getValue('hero_name', 'John Doe'),
            'heroTitle'    => HomeContent::getValue('hero_title', 'Fullstack Developer'),
            'heroBio'      => HomeContent::getValue('hero_bio', ''),
            'heroCta1'     => HomeContent::getValue('hero_cta_1', 'View Projects'),
            'heroCta1Url'  => HomeContent::getValue('hero_cta_1_url', '/projects'),
            'heroCta2'     => HomeContent::getValue('hero_cta_2', 'Contact Me'),
            'heroCta2Url'  => HomeContent::getValue('hero_cta_2_url', '/contact'),
            'heroImage'    => HomeContent::getImage('hero_image'),
            'services'     => Service::orderBy('sort_order')->take(4)->get(),
            'projects'     => Project::with(['category', 'technologies'])->where('is_featured', true)->orderBy('sort_order')->take(3)->get(),
            'technologies' => Technology::all(),
        ]);
    }
}
