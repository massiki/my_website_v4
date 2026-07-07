<div>
    {{-- ═══ BREADCRUMB ═══ --}}
    <section class="bg-primary-50/50 border-b border-primary-100/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" wire:navigate
                   class="text-primary-600 hover:text-primary-700 transition-colors">Home</a>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('blog') }}" wire:navigate
                   class="text-primary-600 hover:text-primary-700 transition-colors">Blog</a>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                @if($post->category)
                    <a href="{{ route('blog', ['category' => $post->category->slug]) }}" wire:navigate
                       class="text-primary-600 hover:text-primary-700 transition-colors">{{ $post->category->name }}</a>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                @endif
                <span class="text-slate-600 truncate max-w-xs">{{ $post->title }}</span>
            </div>
        </div>
    </section>

    {{-- ═══ ARTICLE HEADER ═══ --}}
    <section class="relative overflow-hidden gradient-cyan-soft">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-200/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-primary-300/20 rounded-full blur-3xl"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 relative">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                @if($post->category)
                    <a href="{{ route('blog', ['category' => $post->category->slug]) }}" wire:navigate
                       class="px-3 py-1 bg-white/90 backdrop-blur-sm text-primary-600 text-xs font-semibold rounded-full shadow-sm hover:bg-primary-500 hover:text-white transition-colors">
                        {{ $post->category->name }}
                    </a>
                @endif
                <span class="text-xs text-slate-400 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $post->published_at?->isoFormat('MMM D, YYYY') }}
                </span>
                <span class="text-xs text-slate-400 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-bold text-slate-800 leading-tight mb-4">
                {{ $post->title }}
            </h1>

            @if($post->meta_description)
                <p class="text-lg text-slate-600 leading-relaxed max-w-3xl">{{ $post->meta_description }}</p>
            @endif

            {{-- Author --}}
            <div class="flex items-center gap-3 mt-6 pt-6 border-t border-primary-200/50">
                <div class="w-10 h-10 rounded-full gradient-cyan flex items-center justify-center text-white text-sm font-semibold">
                    {{ substr($post->author?->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-800">{{ $post->author?->name ?? 'Anonymous' }}</p>
                    <p class="text-xs text-slate-400">Author</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ ARTICLE CONTENT ═══ --}}
    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Thumbnail --}}
            @if($post->thumbnail)
                <div class="rounded-2xl overflow-hidden mb-10 shadow-lg">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-64 sm:h-80 lg:h-96 object-cover">
                </div>
            @endif

            {{-- Content --}}
            <article class="prose prose-slate prose-lg max-w-none
                prose-headings:font-heading prose-headings:text-slate-800
                prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4
                prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                prose-p:text-slate-600 prose-p:leading-relaxed
                prose-a:text-primary-600 prose-a:no-underline hover:prose-a:text-primary-700
                prose-img:rounded-2xl prose-img:shadow-md
                prose-blockquote:border-primary-400 prose-blockquote:bg-primary-50/50 prose-blockquote:py-1 prose-blockquote:px-4
                prose-pre:rounded-2xl prose-pre:bg-slate-900
                prose-code:text-primary-600 prose-code:bg-primary-50 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded-md prose-code:text-sm
                prose-strong:text-slate-800
                prose-li:text-slate-600
                prose-hr:border-slate-200">
                {!! $post->content !!}
            </article>

            {{-- Share --}}
            <div class="flex items-center justify-between pt-8 mt-10 border-t border-slate-100">
                <a href="{{ route('blog') }}" wire:navigate
                   class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium transition-colors group">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    Back to Blog
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ RELATED POSTS ═══ --}}
    @if($related->count())
        <section class="section-padding bg-slate-50/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h2 class="text-2xl sm:text-3xl font-heading font-bold text-slate-800 mb-3">Related Articles</h2>
                    <p class="text-slate-500">Continue reading more from the same category or author.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($related as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}" wire:navigate
                           class="glass-card rounded-2xl overflow-hidden card-hover group block">
                            <div class="h-44 bg-gradient-to-br from-primary-100 to-primary-200 overflow-hidden">
                                @if($rel->thumbnail)
                                    <img src="{{ asset('storage/' . $rel->thumbnail) }}"
                                         alt="{{ $rel->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-12 h-12 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                @if($rel->category)
                                    <span class="text-xs font-medium text-primary-500 uppercase tracking-wider">{{ $rel->category->name }}</span>
                                @endif
                                <h3 class="font-heading font-semibold text-slate-800 mt-1 mb-2 group-hover:text-primary-600 transition-colors leading-snug">{{ $rel->title }}</h3>
                                <p class="text-xs text-slate-400">{{ $rel->published_at?->isoFormat('MMM D, YYYY') }} · {{ ceil(str_word_count(strip_tags($rel->content)) / 200) }} min read</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
