<div>
  {{-- ═══ BREADCRUMB ═══ --}}
  <section class="bg-primary-50/50 border-b border-primary-100/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('projects') }}" wire:navigate
          class="text-primary-600 hover:text-primary-700 transition-colors">Projects</a>
        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-slate-600">{{ $project->title }}</span>
      </div>
    </div>
  </section>

  {{-- ═══ PROJECT DETAIL ═══ --}}
  <section class="section-padding bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      {{-- Header --}}
      <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
          <span
            class="px-3 py-1 bg-primary-50 text-primary-600 text-xs font-semibold rounded-full uppercase tracking-wider">{{ $project->category->name }}</span>
          @if ($project->is_featured)
            <span class="px-3 py-1 bg-amber-50 text-amber-600 text-xs font-semibold rounded-full">⭐ Featured</span>
          @endif
        </div>
        <h1 class="text-3xl sm:text-4xl font-heading font-bold text-slate-800 mb-4">{{ $project->title }}</h1>
        <p class="text-lg text-slate-600 leading-relaxed">{{ $project->short_description }}</p>
      </div>

      {{-- Thumbnail --}}
      <div class="rounded-2xl overflow-hidden mb-8 shadow-lg">
        @if ($project->thumbnail)
          <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}"
            class="w-full h-64 sm:h-80 object-cover">
        @else
          <div
            class="w-full h-64 sm:h-80 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
            <svg class="w-20 h-20 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
          </div>
        @endif
      </div>

      {{-- Links --}}
      <div class="flex flex-wrap gap-4 mb-8">
        @if ($project->demo_url)
          <a href="{{ $project->demo_url }}" target="_blank" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            Live Demo
          </a>
        @endif
        @if ($project->github_url)
          <a href="{{ $project->github_url }}" target="_blank" class="btn-outline">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
            </svg>
            GitHub
          </a>
        @endif
      </div>

      {{-- Description --}}
      @if ($project->description)
        <div class="prose prose-slate max-w-none mb-8">
          <h2 class="font-heading text-xl font-semibold text-slate-800 mb-4">About This Project</h2>
          <div class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $project->description }}</div>
        </div>
      @endif

      {{-- Tech Stack --}}
      <div class="glass-card rounded-2xl p-6">
        <h3 class="font-heading font-semibold text-slate-800 mb-4">Technologies Used</h3>
        <div class="flex flex-wrap gap-3">
          @foreach ($project->technologies as $tech)
            <span
              class="px-4 py-2 bg-primary-50 text-primary-600 font-medium text-sm rounded-xl">{{ $tech->name }}</span>
          @endforeach
        </div>
      </div>

      {{-- Back --}}
      <div class="mt-8">
        <a href="{{ route('projects') }}"
          class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
          </svg>
          Back to Projects
        </a>
      </div>
    </div>
  </section>
</div>
