<div class="min-h-[70vh] flex items-center justify-center section-padding">
  <div class="w-full max-w-md">
    <div class="text-center mb-8">
      @php
        $logoImage = \App\Models\HomeContent::getImage('logo_image');
      @endphp
      <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4">
        @if ($logoImage)
          <img src="{{ asset('storage/' . $logoImage) }}" alt="Logo" class="w-9 h-9 rounded-xl object-cover">
        @else
          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
          </svg>
        @endif
      </div>
      <h1 class="text-2xl font-heading font-bold text-slate-800">Welcome Back</h1>
      <p class="text-slate-500 text-sm mt-1">Sign in to your admin panel</p>
    </div>

    <form wire:submit="login" class="glass-card rounded-2xl p-8 space-y-5">
      <div>
        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
        <input wire:model="email" type="email" id="email"
          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none transition-all text-sm"
          placeholder="admin@example.com" autofocus>
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
        <input wire:model="password" type="password" id="password"
          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none transition-all text-sm"
          placeholder="••••••••">
        @error('password')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex items-center">
        <input wire:model="remember" type="checkbox" id="remember"
          class="w-4 h-4 rounded border-slate-300 text-primary-500 focus:ring-primary-400">
        <label for="remember" class="ml-2 text-sm text-slate-600">Remember me</label>
      </div>
      <button type="submit" class="btn-primary w-full justify-center" wire:loading.attr="disabled">
        <span wire:loading.remove>Sign In</span>
        <span wire:loading>Signing in...</span>
      </button>
    </form>
  </div>
</div>
