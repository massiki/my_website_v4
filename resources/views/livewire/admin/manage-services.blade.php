<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-heading font-semibold text-slate-800">Services</h2>
        <button wire:click="create" class="btn-primary text-sm">+ Add Service</button>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-slate-600">Order</th>
                    <th class="px-6 py-3 text-left font-medium text-slate-600">Icon</th>
                    <th class="px-6 py-3 text-left font-medium text-slate-600">Title</th>
                    <th class="px-6 py-3 text-left font-medium text-slate-600 hidden md:table-cell">Technologies</th>
                    <th class="px-6 py-3 text-right font-medium text-slate-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($services as $service)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-6 py-4 text-slate-500">{{ $service->sort_order }}</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 bg-primary-50 text-primary-600 rounded-lg text-xs font-medium">{{ $service->icon }}</span></td>
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $service->title }}</td>
                        <td class="px-6 py-4 text-slate-500 hidden md:table-cell">{{ $service->technologies ? implode(', ', $service->technologies) : '-' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="edit({{ $service->id }})" class="text-primary-600 hover:text-primary-700 font-medium">Edit</button>
                            <button wire:click="delete({{ $service->id }})" wire:confirm="Are you sure?" class="text-red-500 hover:text-red-700 font-medium">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">No services yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-3 border-t border-slate-100">{{ $services->links() }}</div>
    </div>

    {{-- Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-data x-init="document.body.classList.add('overflow-hidden')" x-on:remove="document.body.classList.remove('overflow-hidden')">
            <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" wire:click="$set('showModal', false)"></div>
            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto p-6">
                <h3 class="font-heading font-semibold text-lg text-slate-800 mb-6">{{ $editingId ? 'Edit' : 'Create' }} Service</h3>
                <form wire:submit="save" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Icon Key</label>
                            <select wire:model="icon" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                                <option value="code">Code</option>
                                <option value="smartphone">Smartphone</option>
                                <option value="server">Server</option>
                                <option value="palette">Palette</option>
                                <option value="zap">Zap</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Sort Order</label>
                            <input wire:model="sort_order" type="number" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
                        <input wire:model="title" type="text" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                        <textarea wire:model="description" rows="3" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm resize-none"></textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Technologies (comma-separated)</label>
                        <input wire:model="technologiesInput" type="text" placeholder="Laravel, Vue.js, MySQL" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">Cancel</button>
                        <button type="submit" class="btn-primary text-sm">{{ $editingId ? 'Update' : 'Create' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
