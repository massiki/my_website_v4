<div>
    <form wire:submit="save" class="space-y-6">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-heading font-semibold text-slate-800 mb-6">Contact Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Email *</label>
                    <input wire:model="email" type="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">WhatsApp</label>
                    <input wire:model="whatsapp" type="text" placeholder="+6281234567890" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-heading font-semibold text-slate-800 mb-6">Social Media Links</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div><label class="block text-sm font-medium text-slate-700 mb-2">GitHub URL</label><input wire:model="github" type="url" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                <div><label class="block text-sm font-medium text-slate-700 mb-2">LinkedIn URL</label><input wire:model="linkedin" type="url" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                <div><label class="block text-sm font-medium text-slate-700 mb-2">Twitter URL</label><input wire:model="twitter" type="url" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
                <div><label class="block text-sm font-medium text-slate-700 mb-2">Instagram URL</label><input wire:model="instagram" type="url" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 outline-none text-sm"></div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-heading font-semibold text-slate-800 mb-6">Resume</h2>
            <div class="flex items-center gap-4">
                @if($currentResume)
                    <a href="{{ asset('storage/' . $currentResume) }}" target="_blank" class="text-sm text-primary-600 hover:text-primary-700 font-medium">View Current Resume</a>
                @endif
                <input wire:model="resumeFile" type="file" accept=".pdf,.doc,.docx" class="text-sm text-slate-600">
                @error('resumeFile') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary"><span wire:loading.remove>Save Changes</span><span wire:loading>Saving...</span></button>
        </div>
    </form>
</div>
