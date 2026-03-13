<div>
  {{-- ═══ HERO SECTION ═══ --}}
  <section class="relative overflow-hidden">
    {{-- Background decoration --}}
    <div class="absolute inset-0 gradient-cyan-soft"></div>
    <div class="absolute top-20 right-10 w-72 h-72 bg-primary-200/30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-96 h-96 bg-primary-100/40 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        {{-- Text --}}
        <div class="space-y-6">
          <div
            class="inline-flex items-center gap-2 px-4 py-2 bg-white/80 rounded-full text-sm font-medium text-primary-600 shadow-sm">
            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
            Available for work
          </div>
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-bold text-slate-800 leading-tight">
            Hi, I'm <span class="text-gradient-cyan">{{ $heroName }}</span>
          </h1>
          <p class="text-xl sm:text-2xl font-heading font-medium text-primary-600">{{ $heroTitle }}</p>
          <p class="text-lg text-slate-600 leading-relaxed max-w-xl">{{ $heroBio }}</p>
          <div class="flex flex-wrap gap-4 pt-2">
            <a href="{{ $heroCta1Url }}" wire:navigate class="btn-primary">
              {{ $heroCta1 }}
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </a>
            <a href="{{ $heroCta2Url }}" wire:navigate class="btn-outline">
              {{ $heroCta2 }}
            </a>
          </div>
        </div>

        {{-- Profile Image --}}
        <div class="flex justify-center lg:justify-end">
          <div class="relative">
            <div class="w-64 h-64 sm:w-80 sm:h-80 rounded-3xl gradient-cyan p-1 shadow-xl shadow-primary-200/50">
              @if ($heroImage)
                <img src="{{ asset('storage/' . $heroImage) }}" alt="{{ $heroName }}"
                  class="w-full h-full object-cover rounded-3xl">
              @else
                <div class="w-full h-full rounded-3xl bg-white flex items-center justify-center">
                  <svg class="w-24 h-24 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </div>
              @endif
            </div>
            {{-- Decorative dots --}}
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-primary-100 rounded-2xl -z-10"></div>
            <div class="absolute -top-4 -left-4 w-12 h-12 bg-primary-200/50 rounded-xl -z-10"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══ SERVICES HIGHLIGHT ═══ --}}
  <section class="section-padding bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14">
        <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">What I Do</p>
        <h2 class="text-3xl sm:text-4xl font-heading font-bold text-slate-800">My Services</h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($services as $service)
          <div class="glass-card rounded-2xl p-6 card-hover text-center">
            <div class="w-14 h-14 mx-auto gradient-cyan rounded-2xl flex items-center justify-center mb-5">
              @switch($service->icon)
                @case('code')
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                  </svg>
                @break

                @case('smartphone')
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                  </svg>
                @break

                @case('server')
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                  </svg>
                @break

                @case('palette')
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                  </svg>
                @break

                @default
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                  </svg>
              @endswitch
            </div>
            <h3 class="font-heading font-semibold text-lg text-slate-800 mb-2">{{ $service->title }}</h3>
            <p class="text-sm text-slate-500 leading-relaxed">{{ Str::limit($service->description, 100) }}</p>
          </div>
        @endforeach
      </div>

      <div class="text-center mt-10">
        <a href="{{ route('services') }}" wire:navigate class="btn-outline">
          View All Services
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </a>
      </div>
    </div>
  </section>

  {{-- ═══ FEATURED PROJECTS ═══ --}}
  <section class="section-padding bg-primary-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14">
        <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">Portfolio</p>
        <h2 class="text-3xl sm:text-4xl font-heading font-bold text-slate-800">Featured Projects</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($projects as $project)
          <a href="{{ route('projects.show', $project->slug) }}"
            class="glass-card rounded-2xl overflow-hidden card-hover group block">
            <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-200 relative overflow-hidden">
              @if ($project->thumbnail)
                <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              @else
                <div class="flex items-center justify-center h-full">
                  <svg class="w-16 h-16 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                  </svg>
                </div>
              @endif
              @if ($project->is_featured)
                <span
                  class="absolute top-3 right-3 px-3 py-1 bg-primary-500 text-white text-xs font-semibold rounded-full">Featured</span>
              @endif
            </div>
            <div class="p-6">
              <span
                class="text-xs font-medium text-primary-500 uppercase tracking-wider">{{ $project->category->name }}</span>
              <h3
                class="font-heading font-semibold text-lg text-slate-800 mt-1 mb-2 group-hover:text-primary-600 transition-colors">
                {{ $project->title }}</h3>
              <p class="text-sm text-slate-500 leading-relaxed mb-4">
                {{ Str::limit($project->short_description, 100) }}</p>
              <div class="flex flex-wrap gap-2">
                @foreach ($project->technologies->take(3) as $tech)
                  <span
                    class="px-2.5 py-1 bg-primary-50 text-primary-600 text-xs font-medium rounded-lg">{{ $tech->name }}</span>
                @endforeach
              </div>
            </div>
          </a>
        @endforeach
      </div>

      <div class="text-center mt-10">
        <a href="{{ route('projects') }}" wire:navigate class="btn-primary">
          View All Projects
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </a>
      </div>
    </div>
  </section>

  {{-- ═══ TECH STACK ═══ --}}
  <section class="section-padding bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14">
        <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">Technologies</p>
        <h2 class="text-3xl sm:text-4xl font-heading font-bold text-slate-800">Tech Stack</h2>
      </div>

      <div class="flex flex-wrap justify-center gap-4">
        @foreach ($technologies as $tech)
          <div class="px-5 py-3 glass-card rounded-2xl card-hover flex items-center gap-2">
            <div class="w-3 h-3 gradient-cyan rounded-full"></div>
            <span class="font-medium text-slate-700 text-sm">{{ $tech->name }}</span>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ═══ CTA SECTION ═══ --}}
  <section class="relative overflow-hidden">
    <div class="absolute inset-0 gradient-cyan"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
    </div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
      <h2 class="text-3xl sm:text-4xl font-heading font-bold text-white mb-4">Let's Work Together</h2>
      <p class="text-lg text-cyan-100 mb-8 max-w-2xl mx-auto">
        Have a project in mind? I'd love to hear about it. Let's discuss how I can help bring your ideas to life.
      </p>
      <div class="flex flex-wrap justify-center gap-4">
        <a href="{{ route('contact') }}" wire:navigate
          class="inline-flex items-center gap-2 px-7 py-3 bg-white text-primary-600 font-semibold rounded-xl hover:bg-cyan-50 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
          Get In Touch
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
        </a>
        <a href="{{ route('projects') }}" wire:navigate
          class="inline-flex items-center gap-2 px-7 py-3 border-2 border-white/50 text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
          View Portfolio
        </a>
      </div>
    </div>
  </section>
</div>
