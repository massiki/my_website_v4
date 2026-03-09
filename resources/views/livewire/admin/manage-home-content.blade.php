<div>
    <form wire:submit="save" class="space-y-8">
        {{-- Hero Section --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-heading font-semibold text-slate-800 mb-6">Hero Section</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Name</label>
                    <input wire:model="heroName" type="text" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                    @error('heroName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Title</label>
                    <input wire:model="heroTitle" type="text" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Short Bio</label>
                    <textarea wire:model="heroBio" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">CTA Button 1 Text</label>
                    <input wire:model="heroCta1" type="text" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">CTA Button 1 URL</label>
                    <input wire:model="heroCta1Url" type="text" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">CTA Button 2 Text</label>
                    <input wire:model="heroCta2" type="text" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">CTA Button 2 URL</label>
                    <input wire:model="heroCta2Url" type="text" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm">
                </div>
            </div>
        </div>

        {{-- Profile Image --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-heading font-semibold text-slate-800 mb-6">Profile Photo</h2>
            <div class="flex items-center gap-6">
                @if($currentImage)
                    <img src="{{ asset('storage/' . $currentImage) }}" class="w-24 h-24 rounded-2xl object-cover">
                @endif
                <input wire:model="heroImage" type="file" accept="image/*" class="text-sm text-slate-600">
                @error('heroImage') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- About Bio --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-heading font-semibold text-slate-800 mb-6">About Biography</h2>
            <textarea wire:model="aboutBio" rows="6" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm resize-none"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary">
                <span wire:loading.remove>Save Changes</span>
                <span wire:loading>Saving...</span>
            </button>
        </div>
    </form>
</div>
