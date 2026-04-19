<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Dashboard' }} — Admin</title>

  @php
    $logoImage = \App\Models\HomeContent::getImage('logo_image');
  @endphp
  <link rel="shortcut icon" href="{{ asset('storage/' . $logoImage) }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body class="min-h-screen bg-slate-50" x-data="{ sidebarOpen: true, mobileSidebar: false }">

  <div class="flex min-h-screen">
    {{-- ═══ SIDEBAR ═══ --}}
    {{-- Desktop Sidebar --}}
    <aside class="hidden lg:flex flex-col w-64 bg-white border-r border-slate-200 fixed inset-y-0 left-0 z-30"
      :class="sidebarOpen ? 'lg:w-64' : 'lg:w-20'" x-transition>
      {{-- Logo --}}
      <div class="h-16 flex items-center gap-3 px-6 border-b border-slate-100">
        <div class="w-9 h-9 rounded-xl flex-shrink-0 flex items-center justify-center">
          @if ($logoImage)
            <img src="{{ asset('storage/' . $logoImage) }}" alt="Logo" class="w-9 h-9 rounded-xl object-cover">
          @else
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
            </svg>
          @endif
        </div>
        <span x-show="sidebarOpen" class="font-heading font-bold text-slate-800 text-lg">Admin</span>

      </div>

      {{-- Nav Links --}}
      <nav class="flex-1 py-4 px-3 space-y-1 overflow-y-auto">
        @php
          $adminLinks = [
              [
                  'route' => 'admin.dashboard',
                  'label' => 'Dashboard',
                  'icon' =>
                      'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
              ],
              [
                  'route' => 'admin.home',
                  'label' => 'Home Content',
                  'icon' =>
                      'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
              ],
              [
                  'route' => 'admin.services',
                  'label' => 'Services',
                  'icon' =>
                      'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
              ],
              [
                  'route' => 'admin.technologies',
                  'label' => 'Technologies',
                  'icon' =>
                      'M16.72 8.47l-7.44 3.2a.75.75 0 000 1.36l7.44 3.2a.75.75 0 001.02-.68V9.15a.75.75 0 00-1.02-.68zm-10.39 2.83a.75.75 0 01.47-.93l10-4.29a.75.75 0 01.93.47.75.75 0 01-.47.93l-10 4.29a.75.75 0 01-.93-.47zm0 2.84l10 4.29a.75.75 0 00.93-.47.75.75 0 00-.47-.93l-10-4.29a.75.75 0 00-.93.47.75.75 0 00.47.93z',
              ],

              [
                  'route' => 'admin.projects',
                  'label' => 'Projects',
                  'icon' =>
                      'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
              ],
              [
                  'route' => 'admin.categories',
                  'label' => 'Categories',
                  'icon' =>
                      'M4 4h4v4H4V4zm6 0h4v4h-4V4zm6 0h4v4h-4V4zM4 10h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zM4 16h4v4H4v-4zm6 16h4v-4h-4v4zm6 0h4v-4h-4v4z',
              ],
              [
                  'route' => 'admin.about',
                  'label' => 'About',
                  'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
              ],
              [
                  'route' => 'admin.contact',
                  'label' => 'Contact Info',
                  'icon' =>
                      'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
              ],
              [
                  'route' => 'admin.messages',
                  'label' => 'Messages',
                  'icon' =>
                      'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4',
              ],
          ];
        @endphp

        @foreach ($adminLinks as $link)
          <a href="{{ route($link['route']) }}" wire:navigate
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
              {{ request()->routeIs($link['route']) ? 'bg-primary-50 text-primary-600 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $link['icon'] }}" />
            </svg>
            <span x-show="sidebarOpen">{{ $link['label'] }}</span>
          </a>
        @endforeach
      </nav>

      {{-- Logout --}}
      <div class="p-3 border-t border-slate-100">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
            class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span x-show="sidebarOpen">Logout</span>
          </button>
        </form>
      </div>
    </aside>

    {{-- Mobile Sidebar Overlay --}}
    <div x-show="mobileSidebar" x-cloak class="lg:hidden fixed inset-0 z-40">
      <div @click="mobileSidebar = false" class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
      <aside class="relative w-72 h-full bg-white shadow-xl" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full">
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-100">
          <span class="font-heading font-bold text-slate-800 text-lg">Admin</span>
          <button @click="mobileSidebar = false" class="p-1 rounded-lg text-slate-400 hover:bg-slate-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <nav class="py-4 px-3 space-y-1">
          @foreach ($adminLinks as $link)
            <a href="{{ route($link['route']) }}" wire:navigate
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                                  {{ request()->routeIs($link['route']) ? 'bg-primary-50 text-primary-600' : 'text-slate-600 hover:bg-slate-50' }}">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $link['icon'] }}" />
              </svg>
              {{ $link['label'] }}
            </a>
          @endforeach
        </nav>
        <div class="p-3 border-t border-slate-100">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
              class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              Logout
            </button>
          </form>
        </div>
      </aside>
    </div>

    {{-- ═══ MAIN PANEL ═══ --}}
    <div class="flex-1 flex flex-col" :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'">
      {{-- Topbar --}}
      <header
        class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-20">
        <div class="flex items-center gap-3">
          <button @click="mobileSidebar = true" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <button @click="sidebarOpen = !sidebarOpen"
            class="hidden lg:block p-2 rounded-lg text-slate-600 hover:bg-slate-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <h1 class="text-lg font-heading font-semibold text-slate-800">{{ $title ?? 'Dashboard' }}</h1>
        </div>
        <div class="flex items-center gap-3">
          <a href="{{ route('home') }}" target="_blank"
            class="text-sm text-slate-500 hover:text-primary-600 transition-colors flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            View Site
          </a>
          <div
            class="w-8 h-8 gradient-cyan rounded-full flex items-center justify-center text-white text-sm font-semibold">
            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
          </div>
        </div>
      </header>

      {{-- Content --}}
      <main class="flex-1 p-4 lg:p-8">
        {{-- Success notification --}}
        @if (session()->has('success'))
          <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
            class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="text-green-400 hover:text-green-600">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        @endif

        {{ $slot }}
      </main>
    </div>
  </div>

  @livewireScripts
</body>

</html>
