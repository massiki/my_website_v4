<div>
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-lg font-heading font-semibold text-slate-800">Technologies</h2>
    <button wire:click="create" class="btn-primary text-sm">+ Add</button>
  </div>
  <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-slate-50 border-b border-slate-100">
        <tr>
          <th class="px-4 py-3 text-left font-medium text-slate-600">Name</th>
          <th class="px-4 py-3 text-right font-medium text-slate-600">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse($technologies as $technology)
          <tr class="hover:bg-slate-50/50">
            <td class="px-4 py-3 font-medium text-slate-800">{{ $technology->name }}</td>
            <td class="px-4 py-3 text-right space-x-2">
              <button wire:click="edit({{ $technology->id }})" class="text-primary-600 font-medium">Edit</button>
              <button wire:click="delete({{ $technology->id }})" wire:confirm="Delete?"
                class="text-red-500 font-medium">Delete</button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-4 py-8 text-center text-slate-500">No skills yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="px-6 py-3 border-t border-slate-100">{{ $technologies->links() }}</div>

  @if ($showTechnologyModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
      <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" wire:click="$set('showTechnologyModal', false)"></div>
      <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h3 class="font-heading font-semibold text-lg mb-4">{{ $editTechId ? 'Edit' : 'Add' }} Technology</h3>
        <form wire:submit="save" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
            <input wire:model="technologyName" type="text"
              class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm">
            @error('technologyName')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="flex justify-end gap-3 pt-2">
            <button type="button" wire:click="$set('showTechnologyModal', false)"
              class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-100 rounded-xl">Cancel</button>
            <button type="submit" class="btn-primary text-sm">Save</button>
          </div>
        </form>
      </div>
    </div>
  @endif
</div>
