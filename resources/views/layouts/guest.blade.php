<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $metaDescription ?? 'Personal Portfolio - Fullstack Developer' }}">
  <title>{{ $title ?? 'Portfolio' }} — {{ config('app.name') }}</title>

  @php
    $logoImage = \App\Models\HomeContent::getImage('logo_image');
    $name = \App\Models\HomeContent::where('key', 'hero_name')->first()->value;
  @endphp
  <link rel="shortcut icon" href="{{ asset('storage/' . $logoImage) }}">

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body class="min-h-screen flex flex-col bg-white">

  {{-- ═══ NAVBAR ═══ --}}
  <nav class="sticky top-0 z-50 glass border-b border-primary-100/50" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        {{-- Logo --}}
        <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2">
          <div class="w-9 h-9 rounded-xl flex items-center justify-center">
            @if ($logoImage)
              <img src="{{ asset('storage/' . $logoImage) }}" alt="Logo" class="w-9 h-9 rounded-xl">
            @else
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
              </svg>
            @endif
          </div>
          <span class="font-heading font-bold text-lg text-slate-800">{{ $name }}</span>
        </a>

        {{-- Desktop Links --}}
        <div class="hidden md:flex items-center gap-1">
          @php
            $links = [
                ['route' => 'home', 'label' => 'Home'],
                ['route' => 'services', 'label' => 'Services'],
                ['route' => 'projects', 'label' => 'Projects'],
                ['route' => 'about', 'label' => 'About'],
                ['route' => 'contact', 'label' => 'Contact'],
            ];
          @endphp
          @foreach ($links as $link)
            <a href="{{ route($link['route']) }}" wire:navigate
              class="px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                {{ request()->routeIs($link['route']) ? 'bg-primary-50 text-primary-600' : 'text-slate-600 hover:text-primary-600 hover:bg-primary-50/50' }}">
              {{ $link['label'] }}
            </a>
          @endforeach
        </div>

        {{-- Mobile Toggle --}}
        <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-primary-50">
          <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      {{-- Mobile Menu --}}
      <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1" class="md:hidden pb-4 space-y-1">
        @foreach ($links as $link)
          <a href="{{ route($link['route']) }}" wire:navigate
            class="block px-4 py-2 rounded-lg text-sm font-medium
              {{ request()->routeIs($link['route']) ? 'bg-primary-50 text-primary-600' : 'text-slate-600 hover:bg-primary-50' }}">
            {{ $link['label'] }}
          </a>
        @endforeach
      </div>
    </div>
  </nav>

  {{-- ═══ MAIN CONTENT ═══ --}}
  <main class="flex-1">
    {{ $slot }}
  </main>

  {{-- ═══ FOOTER ═══ --}}
  <footer class="bg-slate-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Brand --}}
        <div>
          <div class="flex items-center gap-2 mb-4">
            <div class="w-9 h-9 bg-white rounded-3xl flex items-center justify-center">
              @php
                $logoImage = \App\Models\HomeContent::getImage('logo_image');
              @endphp
              @if ($logoImage)
                <img src="{{ asset('storage/' . $logoImage) }}" alt="Logo" class="w-9 h-9 rounded-xl">
              @else
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
              @endif
            </div>
            <span class="font-heading font-bold text-lg">Portfolio</span>
          </div>
          <p class="text-slate-400 text-sm leading-relaxed">
            Crafting beautiful digital experiences with modern technologies and clean code.
          </p>
        </div>

        {{-- Quick Links --}}
        <div>
          <h4 class="font-heading font-semibold mb-4">Quick Links</h4>
          <div class="space-y-2">
            @foreach ($links as $link)
              <a href="{{ route($link['route']) }}" wire:navigate
                class="block text-sm text-slate-400 hover:text-primary-400 transition-colors">{{ $link['label'] }}</a>
            @endforeach
          </div>
        </div>

        {{-- Contact --}}
        <div>
          <h4 class="font-heading font-semibold mb-4">Get in Touch</h4>
          <div class="space-y-2 text-sm text-slate-400">
            <p>Have a project in mind?</p>
            <a href="{{ route('contact') }}" wire:navigate
              class="inline-flex items-center gap-2 text-primary-400 hover:text-primary-300 transition-colors font-medium">
              Contact Me
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="mt-10 pt-8 border-t border-slate-700 text-center text-sm text-slate-500">
        &copy; {{ date('Y') }} Portfolio. All rights reserved.
      </div>
    </div>
  </footer>

  {{-- Alpine.js (bundled with Livewire 4) --}}
  @livewireScripts
</body>

</html>
