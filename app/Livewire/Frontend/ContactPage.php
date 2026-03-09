<?php

namespace App\Livewire\Frontend;

use App\Models\ContactInfo;
use App\Models\Message;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Contact')]
class ContactPage extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string|max:255')]
    public string $subject = '';

    #[Validate('required|string|min:10|max:2000')]
    public string $message = '';

    public bool $sent = false;

    public function send(): void
    {
        $this->validate();

        Message::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'subject', 'message']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.frontend.contact-page', [
            'contactEmail'  => ContactInfo::getValue('email'),
            'whatsapp'      => ContactInfo::getValue('whatsapp'),
            'github'        => ContactInfo::getValue('github'),
            'linkedin'      => ContactInfo::getValue('linkedin'),
            'twitter'       => ContactInfo::getValue('twitter'),
            'instagram'     => ContactInfo::getValue('instagram'),
            'resume'        => ContactInfo::getValue('resume'),
        ]);
    }
}
