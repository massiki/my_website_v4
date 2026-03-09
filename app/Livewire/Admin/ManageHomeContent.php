<?php

namespace App\Livewire\Admin;

use App\Models\HomeContent;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Home Content')]
class ManageHomeContent extends Component
{
    use WithFileUploads;

    public string $heroName = '';
    public string $heroTitle = '';
    public string $heroBio = '';
    public string $heroCta1 = '';
    public string $heroCta1Url = '';
    public string $heroCta2 = '';
    public string $heroCta2Url = '';
    public string $aboutBio = '';
    public $heroImage;

    public function mount(): void
    {
        $this->heroName    = HomeContent::getValue('hero_name', '') ?? '';
        $this->heroTitle   = HomeContent::getValue('hero_title', '') ?? '';
        $this->heroBio     = HomeContent::getValue('hero_bio', '') ?? '';
        $this->heroCta1    = HomeContent::getValue('hero_cta_1', '') ?? '';
        $this->heroCta1Url = HomeContent::getValue('hero_cta_1_url', '') ?? '';
        $this->heroCta2    = HomeContent::getValue('hero_cta_2', '') ?? '';
        $this->heroCta2Url = HomeContent::getValue('hero_cta_2_url', '') ?? '';
        $this->aboutBio    = HomeContent::getValue('about_bio', '') ?? '';
    }

    public function save(): void
    {
        $this->validate([
            'heroName'    => 'required|string|max:255',
            'heroTitle'   => 'required|string|max:255',
            'heroBio'     => 'required|string',
            'heroImage'   => 'nullable|image|max:2048',
        ]);

        HomeContent::setValue('hero_name',      $this->heroName);
        HomeContent::setValue('hero_title',     $this->heroTitle);
        HomeContent::setValue('hero_bio',       $this->heroBio);
        HomeContent::setValue('hero_cta_1',     $this->heroCta1);
        HomeContent::setValue('hero_cta_1_url', $this->heroCta1Url);
        HomeContent::setValue('hero_cta_2',     $this->heroCta2);
        HomeContent::setValue('hero_cta_2_url', $this->heroCta2Url);
        HomeContent::setValue('about_bio',     $this->aboutBio);

        if ($this->heroImage) {
            $path = $this->heroImage->store('home', 'public');
            HomeContent::updateOrCreate(
                ['key' => 'hero_image'],
                ['image' => $path]
            );
        }

        session()->flash('success', 'Home content updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.manage-home-content', [
            'currentImage' => HomeContent::getImage('hero_image'),
        ]);
    }
}
