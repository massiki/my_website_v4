<div>
    {{-- ═══ PAGE HEADER ═══ --}}
    <section class="relative overflow-hidden gradient-cyan-soft">
        <div class="absolute top-0 right-0 w-72 h-72 bg-primary-200/30 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 text-center relative">
            <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">Portfolio</p>
            <h1 class="text-4xl sm:text-5xl font-heading font-bold text-slate-800 mb-4">My Projects</h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">Explore my latest work and see how I turn ideas into reality.</p>
        </div>
    </section>

    {{-- ═══ FILTERS & SEARCH ═══ --}}
    <section class="bg-white sticky top-16 z-10 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row items-center gap-4">
                {{-- Search --}}
                <div class="relative w-full sm:w-80">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search projects..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm transition-all">
                </div>

                {{-- Category Filters --}}
                <div class="flex flex-wrap gap-2 flex-1 justify-center sm:justify-end">
                    <button wire:click="filterCategory('')"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all
                                   {{ $category === '' ? 'bg-primary-500 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-primary-50 hover:text-primary-600' }}">
                        All
                    </button>
                    @foreach($categories as $cat)
                        <button wire:click="filterCategory('{{ $cat->slug }}')"
                                class="px-4 py-2 rounded-xl text-sm font-medium transition-all
                                       {{ $category === $cat->slug ? 'bg-primary-500 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-primary-50 hover:text-primary-600' }}">
                            {{ $cat->name }} ({{ $cat->projects_count }})
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ PROJECTS GRID ═══ --}}
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($projects->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" wire:loading.class="opacity-50">
                    @foreach($projects as $project)
                        <a href="{{ route('projects.show', $project->slug) }}" class="glass-card rounded-2xl overflow-hidden card-hover group block">
                            <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-200 relative overflow-hidden">
                                @if($project->thumbnail)
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-16 h-16 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    </div>
                                @endif
                                @if($project->is_featured)
                                    <span class="absolute top-3 right-3 px-3 py-1 bg-primary-500 text-white text-xs font-semibold rounded-full">Featured</span>
                                @endif
                            </div>
                            <div class="p-6">
                                <span class="text-xs font-medium text-primary-500 uppercase tracking-wider">{{ $project->category->name }}</span>
                                <h3 class="font-heading font-semibold text-lg text-slate-800 mt-1 mb-2 group-hover:text-primary-600 transition-colors">{{ $project->title }}</h3>
                                <p class="text-sm text-slate-500 leading-relaxed mb-4">{{ Str::limit($project->short_description, 100) }}</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($project->technologies->take(3) as $tech)
                                        <span class="px-2.5 py-1 bg-primary-50 text-primary-600 text-xs font-medium rounded-lg">{{ $tech->name }}</span>
                                    @endforeach
                                    @if($project->technologies->count() > 3)
                                        <span class="px-2.5 py-1 bg-slate-100 text-slate-500 text-xs font-medium rounded-lg">+{{ $project->technologies->count() - 3 }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3 class="text-xl font-heading font-semibold text-slate-600 mb-2">No Projects Found</h3>
                    <p class="text-slate-500">Try adjusting your search or filter criteria.</p>
                </div>
            @endif
        </div>
    </section>
</div>
