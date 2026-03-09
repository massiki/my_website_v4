<?php

namespace App\Livewire\Admin;

use App\Models\ContactInfo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Contact Info')]
class ManageContactInfo extends Component
{
    use WithFileUploads;

    public string $email = '';
    public string $whatsapp = '';
    public string $github = '';
    public string $linkedin = '';
    public string $twitter = '';
    public string $instagram = '';
    public $resumeFile;

    public function mount(): void
    {
        $this->email     = ContactInfo::getValue('email', '') ?? '';
        $this->whatsapp  = ContactInfo::getValue('whatsapp', '') ?? '';
        $this->github    = ContactInfo::getValue('github', '') ?? '';
        $this->linkedin  = ContactInfo::getValue('linkedin', '') ?? '';
        $this->twitter   = ContactInfo::getValue('twitter', '') ?? '';
        $this->instagram = ContactInfo::getValue('instagram', '') ?? '';
    }

    public function save(): void
    {
        $this->validate([
            'email'      => 'required|email',
            'resumeFile' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        ContactInfo::setValue('email', $this->email);
        ContactInfo::setValue('whatsapp', $this->whatsapp);
        ContactInfo::setValue('github', $this->github);
        ContactInfo::setValue('linkedin', $this->linkedin);
        ContactInfo::setValue('twitter', $this->twitter);
        ContactInfo::setValue('instagram', $this->instagram);

        if ($this->resumeFile) {
            $path = $this->resumeFile->store('resume', 'public');
            ContactInfo::setValue('resume', $path);
        }

        session()->flash('success', 'Contact info updated!');
    }

    public function render()
    {
        return view('livewire.admin.manage-contact-info', [
            'currentResume' => ContactInfo::getValue('resume'),
        ]);
    }
}
