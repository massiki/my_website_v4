<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Messages')]
class ManageMessages extends Component
{
    use WithPagination;

    public bool $showDetail = false;
    public ?Message $viewing = null;

    public function view(int $id): void
    {
        $this->viewing = Message::findOrFail($id);
        $this->viewing->update(['is_read' => true]);
        $this->showDetail = true;
    }

    public function toggleRead(int $id): void
    {
        $msg = Message::findOrFail($id);
        $msg->update(['is_read' => !$msg->is_read]);
    }

    public function delete(int $id): void
    {
        Message::findOrFail($id)->delete();
        $this->showDetail = false;
        session()->flash('success', 'Message deleted!');
    }

    public function render()
    {
        return view('livewire.admin.manage-messages', [
            'messages' => Message::latest()->paginate(15),
        ]);
    }
}
