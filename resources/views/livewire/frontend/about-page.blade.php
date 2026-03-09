<div>
    <section class="relative overflow-hidden gradient-cyan-soft">
        <div class="absolute top-0 right-0 w-72 h-72 bg-primary-200/30 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 text-center relative">
            <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">Get to Know Me</p>
            <h1 class="text-4xl sm:text-5xl font-heading font-bold text-slate-800 mb-4">About Me</h1>
        </div>
    </section>

    <section class="section-padding bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                <div class="flex justify-center">
                    <div class="w-64 h-64 rounded-3xl gradient-cyan p-1 shadow-xl shadow-primary-200/50">
                        @if($heroImage)
                            <img src="{{ asset('storage/' . $heroImage) }}" alt="{{ $heroName }}" class="w-full h-full object-cover rounded-3xl">
                        @else
                            <div class="w-full h-full rounded-3xl bg-white flex items-center justify-center">
                                <svg class="w-24 h-24 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-heading font-bold text-slate-800 mb-2">{{ $heroName }}</h2>
                    <p class="text-primary-600 font-medium mb-6">{{ $heroTitle }}</p>
                    <div class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $bio }}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-primary-50/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">Career</p>
                <h2 class="text-3xl sm:text-4xl font-heading font-bold text-slate-800">Work Experience</h2>
            </div>
            <div class="space-y-0 relative">
                <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-primary-200 hidden sm:block"></div>
                @foreach($experiences as $exp)
                    <div class="relative flex items-start gap-6 pb-10 last:pb-0">
                        <div class="hidden sm:flex w-12 h-12 gradient-cyan rounded-full items-center justify-center flex-shrink-0 z-10 shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="glass-card rounded-2xl p-6 flex-1">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2">
                                <h3 class="font-heading font-semibold text-lg text-slate-800">{{ $exp->position }}</h3>
                                <span class="text-sm text-primary-500 font-medium">
                                    {{ $exp->start_date->format('M Y') }} — {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}
                                </span>
                            </div>
                            <p class="text-primary-600 font-medium text-sm mb-3">{{ $exp->company }}</p>
                            @if($exp->description)
                                <p class="text-slate-600 text-sm leading-relaxed">{{ $exp->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-padding bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">Academic</p>
                <h2 class="text-3xl sm:text-4xl font-heading font-bold text-slate-800">Education</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($educations as $edu)
                    <div class="glass-card rounded-2xl p-6 card-hover">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 gradient-cyan rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                            </div>
                            <div>
                                <h3 class="font-heading font-semibold text-slate-800">{{ $edu->degree }}</h3>
                                @if($edu->field_of_study)
                                    <p class="text-primary-600 text-sm font-medium">{{ $edu->field_of_study }}</p>
                                @endif
                                <p class="text-slate-600 text-sm mt-1">{{ $edu->institution }}</p>
                                <p class="text-slate-400 text-xs mt-1">{{ $edu->start_year }} — {{ $edu->end_year ?? 'Present' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-padding bg-primary-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <p class="text-primary-500 font-semibold text-sm uppercase tracking-wider mb-2">Expertise</p>
                <h2 class="text-3xl sm:text-4xl font-heading font-bold text-slate-800">Skills & Tools</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($skills as $category => $categorySkills)
                    <div class="glass-card rounded-2xl p-6">
                        <h3 class="font-heading font-semibold text-lg text-slate-800 mb-5 flex items-center gap-2">
                            <div class="w-3 h-3 gradient-cyan rounded-full"></div>
                            {{ $category }}
                        </h3>
                        <div class="space-y-4">
                            @foreach($categorySkills as $skill)
                                <div>
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-sm font-medium text-slate-700">{{ $skill->name }}</span>
                                        <span class="text-xs text-primary-500 font-semibold">{{ $skill->level }}%</span>
                                    </div>
                                    <div class="h-2 bg-primary-100 rounded-full overflow-hidden">
                                        <div class="h-full gradient-cyan rounded-full" style="width: {{ $skill->level }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
