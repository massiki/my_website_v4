<div>
    {{-- ═══ PAGE HEADER ═══ --}}
    <section class="relative overflow-hidden gradient-cyan-soft">
        <div class="absolute top-0 right-0 w-72 h-72 bg-primary-200/30 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 text-center relative">
            <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">What I Offer</p>
            <h1 class="text-4xl sm:text-5xl font-heading font-bold text-slate-800 mb-4">My Services</h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">Professional services tailored to bring your digital ideas to life with modern technologies and best practices.</p>
        </div>
    </section>

    {{-- ═══ SERVICES LIST ═══ --}}
    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($services as $service)
                    <div class="glass-card rounded-2xl p-8 card-hover">
                        <div class="flex items-start gap-5">
                            <div class="w-14 h-14 gradient-cyan rounded-2xl flex-shrink-0 flex items-center justify-center">
                                @switch($service->icon)
                                    @case('code')
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                        @break
                                    @case('smartphone')
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        @break
                                    @case('server')
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/></svg>
                                        @break
                                    @case('palette')
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                                        @break
                                    @default
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                @endswitch
                            </div>
                            <div class="flex-1">
                                <h3 class="font-heading font-semibold text-xl text-slate-800 mb-2">{{ $service->title }}</h3>
                                <p class="text-slate-600 leading-relaxed mb-4">{{ $service->description }}</p>
                                @if($service->technologies)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($service->technologies as $tech)
                                            <span class="px-3 py-1 bg-primary-50 text-primary-600 text-xs font-medium rounded-lg">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
