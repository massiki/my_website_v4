<?php

namespace App\Livewire\Frontend;

use App\Models\Education;
use App\Models\Experience;
use App\Models\HomeContent;
use App\Models\Skill;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('About')]
class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.frontend.about-page', [
            'bio'          => HomeContent::getValue('about_bio', ''),
            'heroImage'    => HomeContent::getImage('hero_image'),
            'heroName'     => HomeContent::getValue('hero_name', 'John Doe'),
            'heroTitle'    => HomeContent::getValue('hero_title', 'Fullstack Developer'),
            'experiences'  => Experience::orderBy('sort_order')->get(),
            'educations'   => Education::orderBy('sort_order')->get(),
            'skills'       => Skill::orderBy('sort_order')->get()->groupBy('category'),
        ]);
    }
}
