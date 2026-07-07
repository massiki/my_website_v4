<div>
    {{-- ═══ PAGE HEADER ═══ --}}
    <section class="relative overflow-hidden gradient-cyan-soft">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-200/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-primary-300/20 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 text-center relative">
            <div class="animate-fade-up">
                <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">Articles & Insights</p>
                <h1 class="text-4xl sm:text-5xl font-heading font-bold text-slate-800 mb-4">Latest Blog Posts</h1>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Thoughts, tutorials, and insights on web development, design, and technology.</p>
            </div>
        </div>
    </section>

    {{-- ═══ FILTERS & SEARCH ═══ --}}
    <section class="bg-white sticky top-16 z-10 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row items-center gap-4">
                {{-- Search --}}
                <div class="relative w-full sm:w-80">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search articles..."
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
                            {{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ BLOG GRID ═══ --}}
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($blogs->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8" wire:loading.class="opacity-50">
                    @foreach($blogs as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" wire:navigate
                           class="glass-card rounded-2xl overflow-hidden card-hover group block">
                            <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-200 relative overflow-hidden">
                                @if($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-16 h-16 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                @endif
                                @if($post->category)
                                    <span class="absolute top-3 left-3 px-3 py-1 bg-white/90 backdrop-blur-sm text-primary-600 text-xs font-semibold rounded-full shadow-sm">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                            </div>

                            <div class="p-6">
                                <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $post->published_at?->isoFormat('MMM D, YYYY') }}</span>
                                    <span class="text-slate-300">·</span>
                                    <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                                </div>

                                <h3 class="font-heading font-semibold text-lg text-slate-800 mb-2 group-hover:text-primary-600 transition-colors leading-snug">
                                    {{ $post->title }}
                                </h3>

                                <p class="text-sm text-slate-500 leading-relaxed mb-4">
                                    {{ Str::limit($post->meta_description ?? strip_tags($post->content), 120) }}
                                </p>

                                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full gradient-cyan flex items-center justify-center text-white text-xs font-semibold">
                                            {{ substr($post->author?->name ?? 'A', 0, 1) }}
                                        </div>
                                        <span class="text-xs font-medium text-slate-600">{{ $post->author?->name ?? 'Anonymous' }}</span>
                                    </div>
                                    <span class="text-xs font-semibold text-primary-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                        Read More →
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <h3 class="text-xl font-heading font-semibold text-slate-600 mb-2">No Articles Found</h3>
                    <p class="text-slate-500 mb-6">No blog posts match your criteria. Try a different search or filter.</p>
                    <a href="{{ route('blog') }}" wire:navigate class="btn-primary text-sm">
                        View All Articles
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>
