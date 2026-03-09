<div>
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <h2 class="text-lg font-heading font-semibold text-slate-800">Projects</h2>
        <div class="flex items-center gap-3">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search..." class="px-4 py-2 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm w-48">
            <button wire:click="create" class="btn-primary text-sm">+ Add Project</button>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">#</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Title</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600 hidden md:table-cell">Category</th>
                    <th class="px-4 py-3 text-center font-medium text-slate-600">Featured</th>
                    <th class="px-4 py-3 text-right font-medium text-slate-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($projects as $project)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-4 py-3 text-slate-500">{{ $project->sort_order }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if($project->thumbnail)
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}" class="w-10 h-10 rounded-lg object-cover">
                                @endif
                                <span class="font-medium text-slate-800">{{ $project->title }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-500 hidden md:table-cell">{{ $project->category->name }}</td>
                        <td class="px-4 py-3 text-center">
                            <button wire:click="toggleFeatured({{ $project->id }})" class="text-lg">
                                {{ $project->is_featured ? '⭐' : '☆' }}
                            </button>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <button wire:click="edit({{ $project->id }})" class="text-primary-600 hover:text-primary-700 font-medium">Edit</button>
                            <button wire:click="delete({{ $project->id }})" wire:confirm="Delete this project?" class="text-red-500 hover:text-red-700 font-medium">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">No projects yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-3 border-t border-slate-100">{{ $projects->links() }}</div>
    </div>

    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" wire:click="$set('showModal', false)"></div>
            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
                <h3 class="font-heading font-semibold text-lg text-slate-800 mb-6">{{ $editingId ? 'Edit' : 'Create' }} Project</h3>
                <form wire:submit="save" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
                            <input wire:model="title" type="text" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Category</label>
                            <select wire:model="category_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm">
                                <option value="">Select...</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Sort Order</label>
                            <input wire:model="sort_order" type="number" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Short Description</label>
                            <textarea wire:model="short_description" rows="2" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm resize-none"></textarea>
                            @error('short_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Full Description</label>
                            <textarea wire:model="description" rows="4" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Demo URL</label>
                            <input wire:model="demo_url" type="url" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">GitHub URL</label>
                            <input wire:model="github_url" type="url" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Technologies</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($technologies as $tech)
                                    <label class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border cursor-pointer text-xs font-medium transition-colors {{ in_array($tech->id, $selectedTechs) ? 'bg-primary-50 border-primary-300 text-primary-700' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                                        <input type="checkbox" wire:model="selectedTechs" value="{{ $tech->id }}" class="hidden">
                                        {{ $tech->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Thumbnail</label>
                            <input wire:model="thumbnail" type="file" accept="image/*" class="text-sm text-slate-600">
                            @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex items-center pt-6">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input wire:model="is_featured" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-primary-500 focus:ring-primary-400">
                                <span class="text-sm font-medium text-slate-700">Featured Project</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl">Cancel</button>
                        <button type="submit" class="btn-primary text-sm">{{ $editingId ? 'Update' : 'Create' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
