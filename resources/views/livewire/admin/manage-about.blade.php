<div>
    {{-- Tabs --}}
    <div class="flex gap-2 mb-6">
        @foreach(['experience' => 'Experience', 'education' => 'Education', 'skills' => 'Skills'] as $key => $label)
            <button wire:click="$set('activeTab', '{{ $key }}')" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ $activeTab === $key ? 'bg-primary-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-primary-50' }}">{{ $label }}</button>
        @endforeach
    </div>

    {{-- Experience Tab --}}
    @if($activeTab === 'experience')
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-heading font-semibold text-slate-800">Work Experience</h2>
            <button wire:click="createExp" class="btn-primary text-sm">+ Add</button>
        </div>
        <div class="space-y-3">
            @forelse($experiences as $exp)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center justify-between">
                    <div>
                        <p class="font-medium text-slate-800">{{ $exp->position }}</p>
                        <p class="text-sm text-primary-600">{{ $exp->company }}</p>
                        <p class="text-xs text-slate-400">{{ $exp->start_date->format('M Y') }} — {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="editExp({{ $exp->id }})" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Edit</button>
                        <button wire:click="deleteExp({{ $exp->id }})" wire:confirm="Delete?" class="text-sm text-red-500 hover:text-red-700 font-medium">Delete</button>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-500 text-center py-8">No experience entries.</p>
            @endforelse
        </div>

        @if($showExpModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" wire:click="$set('showExpModal', false)"></div>
                <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">
                    <h3 class="font-heading font-semibold text-lg mb-4">{{ $editingExpId ? 'Edit' : 'Add' }} Experience</h3>
                    <form wire:submit="saveExp" class="space-y-4">
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Company</label><input wire:model="expCompany" type="text" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm">@error('expCompany') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror</div>
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Position</label><input wire:model="expPosition" type="text" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm">@error('expPosition') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror</div>
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Description</label><textarea wire:model="expDescription" rows="3" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm resize-none"></textarea></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Start Date</label><input wire:model="expStartDate" type="date" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">End Date (blank=present)</label><input wire:model="expEndDate" type="date" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                        </div>
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Sort Order</label><input wire:model="expSortOrder" type="number" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                        <div class="flex justify-end gap-3 pt-2"><button type="button" wire:click="$set('showExpModal', false)" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-100 rounded-xl">Cancel</button><button type="submit" class="btn-primary text-sm">Save</button></div>
                    </form>
                </div>
            </div>
        @endif
    @endif

    {{-- Education Tab --}}
    @if($activeTab === 'education')
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-heading font-semibold text-slate-800">Education</h2>
            <button wire:click="createEdu" class="btn-primary text-sm">+ Add</button>
        </div>
        <div class="space-y-3">
            @forelse($educations as $edu)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center justify-between">
                    <div>
                        <p class="font-medium text-slate-800">{{ $edu->degree }}</p>
                        <p class="text-sm text-primary-600">{{ $edu->institution }}</p>
                        <p class="text-xs text-slate-400">{{ $edu->start_year }} — {{ $edu->end_year ?? 'Present' }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="editEdu({{ $edu->id }})" class="text-sm text-primary-600 font-medium">Edit</button>
                        <button wire:click="deleteEdu({{ $edu->id }})" wire:confirm="Delete?" class="text-sm text-red-500 font-medium">Delete</button>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-500 text-center py-8">No education entries.</p>
            @endforelse
        </div>

        @if($showEduModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" wire:click="$set('showEduModal', false)"></div>
                <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">
                    <h3 class="font-heading font-semibold text-lg mb-4">{{ $editingEduId ? 'Edit' : 'Add' }} Education</h3>
                    <form wire:submit="saveEdu" class="space-y-4">
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Institution</label><input wire:model="eduInstitution" type="text" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm">@error('eduInstitution') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror</div>
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Degree</label><input wire:model="eduDegree" type="text" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Field of Study</label><input wire:model="eduField" type="text" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">Start Year</label><input wire:model="eduStartYear" type="text" maxlength="4" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                            <div><label class="block text-sm font-medium text-slate-700 mb-1">End Year</label><input wire:model="eduEndYear" type="text" maxlength="4" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                        </div>
                        <div class="flex justify-end gap-3 pt-2"><button type="button" wire:click="$set('showEduModal', false)" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-100 rounded-xl">Cancel</button><button type="submit" class="btn-primary text-sm">Save</button></div>
                    </form>
                </div>
            </div>
        @endif
    @endif

    {{-- Skills Tab --}}
    @if($activeTab === 'skills')
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-heading font-semibold text-slate-800">Skills</h2>
            <button wire:click="createSkill" class="btn-primary text-sm">+ Add</button>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-100"><tr>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Name</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Category</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Level</th>
                    <th class="px-4 py-3 text-right font-medium text-slate-600">Actions</th>
                </tr></thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($skills as $skill)
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-4 py-3 font-medium text-slate-800">{{ $skill->name }}</td>
                            <td class="px-4 py-3"><span class="px-2 py-1 bg-primary-50 text-primary-600 rounded-lg text-xs">{{ $skill->category }}</span></td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2"><div class="w-20 h-2 bg-primary-100 rounded-full overflow-hidden"><div class="h-full gradient-cyan rounded-full" style="width:{{ $skill->level }}%"></div></div><span class="text-xs text-slate-500">{{ $skill->level }}%</span></div>
                            </td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <button wire:click="editSkill({{ $skill->id }})" class="text-primary-600 font-medium">Edit</button>
                                <button wire:click="deleteSkill({{ $skill->id }})" wire:confirm="Delete?" class="text-red-500 font-medium">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">No skills yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($showSkillModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" wire:click="$set('showSkillModal', false)"></div>
                <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                    <h3 class="font-heading font-semibold text-lg mb-4">{{ $editingSkillId ? 'Edit' : 'Add' }} Skill</h3>
                    <form wire:submit="saveSkill" class="space-y-4">
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Name</label><input wire:model="skillName" type="text" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm">@error('skillName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror</div>
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Category</label><select wire:model="skillCategory" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"><option>Backend</option><option>Frontend</option><option>Tools</option><option>Other</option></select></div>
                        <div><label class="block text-sm font-medium text-slate-700 mb-1">Level ({{ $skillLevel }}%)</label><input wire:model.live="skillLevel" type="range" min="1" max="100" class="w-full"></div>
                        <div class="flex justify-end gap-3 pt-2"><button type="button" wire:click="$set('showSkillModal', false)" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-100 rounded-xl">Cancel</button><button type="submit" class="btn-primary text-sm">Save</button></div>
                    </form>
                </div>
            </div>
        @endif
    @endif
</div>
