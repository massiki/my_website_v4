<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Manage Services')]
class ManageServices extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $editingId = null;
    public string $icon = 'code';
    public string $title = '';
    public string $description = '';
    public string $technologiesInput = '';
    public int $sort_order = 0;

    protected function rules(): array
    {
        return [
            'icon'        => 'required|string|max:50',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order'  => 'integer|min:0',
        ];
    }

    public function create(): void
    {
        $this->reset(['editingId', 'icon', 'title', 'description', 'technologiesInput', 'sort_order']);
        $this->icon = 'code';
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $service = Service::findOrFail($id);
        $this->editingId = $service->id;
        $this->icon = $service->icon;
        $this->title = $service->title;
        $this->description = $service->description;
        $this->technologiesInput = $service->technologies ? implode(', ', $service->technologies) : '';
        $this->sort_order = $service->sort_order;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();
        $techs = array_map('trim', array_filter(explode(',', $this->technologiesInput)));

        Service::updateOrCreate(
            ['id' => $this->editingId],
            [
                'icon'         => $this->icon,
                'title'        => $this->title,
                'description'  => $this->description,
                'technologies' => $techs ?: null,
                'sort_order'   => $this->sort_order,
            ]
        );

        $this->showModal = false;
        session()->flash('success', $this->editingId ? 'Service updated!' : 'Service created!');
        $this->reset(['editingId', 'icon', 'title', 'description', 'technologiesInput', 'sort_order']);
    }

    public function delete(int $id): void
    {
        Service::findOrFail($id)->delete();
        session()->flash('success', 'Service deleted!');
    }

    public function render()
    {
        return view('livewire.admin.manage-services', [
            'services' => Service::orderBy('sort_order')->paginate(10),
        ]);
    }
}
