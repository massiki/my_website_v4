<?php

namespace App\Livewire\Admin;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Manage About')]
class ManageAbout extends Component
{
    public string $activeTab = 'experience';

    // Experience fields
    public bool $showExpModal = false;
    public ?int $editingExpId = null;
    public string $expCompany = '';
    public string $expPosition = '';
    public string $expDescription = '';
    public string $expStartDate = '';
    public string $expEndDate = '';
    public int $expSortOrder = 0;

    // Education fields
    public bool $showEduModal = false;
    public ?int $editingEduId = null;
    public string $eduInstitution = '';
    public string $eduDegree = '';
    public string $eduField = '';
    public string $eduStartYear = '';
    public string $eduEndYear = '';
    public int $eduSortOrder = 0;

    // Skill fields
    public bool $showSkillModal = false;
    public ?int $editingSkillId = null;
    public string $skillName = '';
    public string $skillCategory = 'Backend';
    public int $skillLevel = 50;
    public int $skillSortOrder = 0;

    // ── Experience CRUD ──
    public function createExp(): void
    {
        $this->reset(['editingExpId','expCompany','expPosition','expDescription','expStartDate','expEndDate','expSortOrder']);
        $this->showExpModal = true;
    }

    public function editExp(int $id): void
    {
        $exp = Experience::findOrFail($id);
        $this->editingExpId = $exp->id;
        $this->expCompany = $exp->company;
        $this->expPosition = $exp->position;
        $this->expDescription = $exp->description ?? '';
        $this->expStartDate = $exp->start_date->format('Y-m-d');
        $this->expEndDate = $exp->end_date?->format('Y-m-d') ?? '';
        $this->expSortOrder = $exp->sort_order;
        $this->showExpModal = true;
    }

    public function saveExp(): void
    {
        $this->validate([
            'expCompany'   => 'required|string|max:255',
            'expPosition'  => 'required|string|max:255',
            'expStartDate' => 'required|date',
        ]);

        Experience::updateOrCreate(['id' => $this->editingExpId], [
            'company'     => $this->expCompany,
            'position'    => $this->expPosition,
            'description' => $this->expDescription,
            'start_date'  => $this->expStartDate,
            'end_date'    => $this->expEndDate ?: null,
            'sort_order'  => $this->expSortOrder,
        ]);
        $this->showExpModal = false;
        session()->flash('success', 'Experience saved!');
    }

    public function deleteExp(int $id): void
    {
        Experience::findOrFail($id)->delete();
        session()->flash('success', 'Experience deleted!');
    }

    // ── Education CRUD ──
    public function createEdu(): void
    {
        $this->reset(['editingEduId','eduInstitution','eduDegree','eduField','eduStartYear','eduEndYear','eduSortOrder']);
        $this->showEduModal = true;
    }

    public function editEdu(int $id): void
    {
        $edu = Education::findOrFail($id);
        $this->editingEduId = $edu->id;
        $this->eduInstitution = $edu->institution;
        $this->eduDegree = $edu->degree;
        $this->eduField = $edu->field_of_study ?? '';
        $this->eduStartYear = $edu->start_year;
        $this->eduEndYear = $edu->end_year ?? '';
        $this->eduSortOrder = $edu->sort_order;
        $this->showEduModal = true;
    }

    public function saveEdu(): void
    {
        $this->validate([
            'eduInstitution' => 'required|string|max:255',
            'eduDegree'      => 'required|string|max:255',
            'eduStartYear'   => 'required|string|max:4',
        ]);

        Education::updateOrCreate(['id' => $this->editingEduId], [
            'institution'    => $this->eduInstitution,
            'degree'         => $this->eduDegree,
            'field_of_study' => $this->eduField ?: null,
            'start_year'     => $this->eduStartYear,
            'end_year'       => $this->eduEndYear ?: null,
            'sort_order'     => $this->eduSortOrder,
        ]);
        $this->showEduModal = false;
        session()->flash('success', 'Education saved!');
    }

    public function deleteEdu(int $id): void
    {
        Education::findOrFail($id)->delete();
        session()->flash('success', 'Education deleted!');
    }

    // ── Skill CRUD ──
    public function createSkill(): void
    {
        $this->reset(['editingSkillId','skillName','skillCategory','skillLevel','skillSortOrder']);
        $this->skillCategory = 'Backend';
        $this->skillLevel = 50;
        $this->showSkillModal = true;
    }

    public function editSkill(int $id): void
    {
        $skill = Skill::findOrFail($id);
        $this->editingSkillId = $skill->id;
        $this->skillName = $skill->name;
        $this->skillCategory = $skill->category;
        $this->skillLevel = $skill->level;
        $this->skillSortOrder = $skill->sort_order;
        $this->showSkillModal = true;
    }

    public function saveSkill(): void
    {
        $this->validate([
            'skillName'     => 'required|string|max:255',
            'skillCategory' => 'required|string|max:50',
            'skillLevel'    => 'required|integer|min:1|max:100',
        ]);

        Skill::updateOrCreate(['id' => $this->editingSkillId], [
            'name'       => $this->skillName,
            'category'   => $this->skillCategory,
            'level'      => $this->skillLevel,
            'sort_order' => $this->skillSortOrder,
        ]);
        $this->showSkillModal = false;
        session()->flash('success', 'Skill saved!');
    }

    public function deleteSkill(int $id): void
    {
        Skill::findOrFail($id)->delete();
        session()->flash('success', 'Skill deleted!');
    }

    public function render()
    {
        return view('livewire.admin.manage-about', [
            'experiences' => Experience::orderBy('sort_order')->get(),
            'educations'  => Education::orderBy('sort_order')->get(),
            'skills'      => Skill::orderBy('sort_order')->get(),
        ]);
    }
}
