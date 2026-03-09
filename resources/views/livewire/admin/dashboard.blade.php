<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Projects --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 gradient-cyan rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <span class="text-xs font-medium text-primary-500 bg-primary-50 px-2 py-1 rounded-lg">{{ $featuredProjects }} featured</span>
            </div>
            <p class="text-3xl font-heading font-bold text-slate-800">{{ $totalProjects }}</p>
            <p class="text-sm text-slate-500 mt-1">Total Projects</p>
        </div>
        {{-- Services --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-violet-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-heading font-bold text-slate-800">{{ $totalServices }}</p>
            <p class="text-sm text-slate-500 mt-1">Total Services</p>
        </div>
        {{-- Messages --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                @if($unreadMessages > 0)
                    <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">{{ $unreadMessages }} unread</span>
                @endif
            </div>
            <p class="text-3xl font-heading font-bold text-slate-800">{{ $totalMessages }}</p>
            <p class="text-sm text-slate-500 mt-1">Total Messages</p>
        </div>
        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm flex flex-col justify-center">
            <p class="text-sm font-medium text-slate-700 mb-3">Quick Actions</p>
            <div class="space-y-2">
                <a href="{{ route('admin.projects') }}" class="block text-sm text-primary-600 hover:text-primary-700 font-medium">+ New Project</a>
                <a href="{{ route('admin.messages') }}" class="block text-sm text-primary-600 hover:text-primary-700 font-medium">View Messages</a>
                <a href="{{ route('home') }}" target="_blank" class="block text-sm text-slate-500 hover:text-slate-700 font-medium">View Website →</a>
            </div>
        </div>
    </div>

    {{-- Recent Messages --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-heading font-semibold text-slate-800">Recent Messages</h2>
            <a href="{{ route('admin.messages') }}" class="text-sm text-primary-600 hover:text-primary-700">View All</a>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($recentMessages as $msg)
                <div class="px-6 py-4 flex items-center gap-4">
                    <div class="w-10 h-10 {{ $msg->is_read ? 'bg-slate-100' : 'gradient-cyan' }} rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="{{ $msg->is_read ? 'text-slate-500' : 'text-white' }} text-sm font-semibold">{{ substr($msg->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 {{ !$msg->is_read ? 'font-semibold' : '' }}">{{ $msg->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ $msg->subject ?: Str::limit($msg->message, 50) }}</p>
                    </div>
                    <span class="text-xs text-slate-400 flex-shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-sm text-slate-500">No messages yet.</div>
            @endforelse
        </div>
    </div>
</div>
