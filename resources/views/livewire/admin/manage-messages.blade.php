<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-heading font-semibold text-slate-800">Messages</h2>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Status</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Name</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600 hidden md:table-cell">Email</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600 hidden lg:table-cell">Subject</th>
                    <th class="px-4 py-3 text-left font-medium text-slate-600">Date</th>
                    <th class="px-4 py-3 text-right font-medium text-slate-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($messages as $msg)
                    <tr class="hover:bg-slate-50/50 {{ !$msg->is_read ? 'bg-primary-50/30' : '' }}">
                        <td class="px-4 py-3">
                            <button wire:click="toggleRead({{ $msg->id }})" class="w-3 h-3 rounded-full {{ $msg->is_read ? 'bg-slate-300' : 'bg-primary-500 animate-pulse' }}" title="{{ $msg->is_read ? 'Mark unread' : 'Mark read' }}"></button>
                        </td>
                        <td class="px-4 py-3 font-medium {{ !$msg->is_read ? 'text-slate-800 font-semibold' : 'text-slate-600' }}">{{ $msg->name }}</td>
                        <td class="px-4 py-3 text-slate-500 hidden md:table-cell">{{ $msg->email }}</td>
                        <td class="px-4 py-3 text-slate-500 hidden lg:table-cell">{{ $msg->subject ?: '-' }}</td>
                        <td class="px-4 py-3 text-slate-400 text-xs">{{ $msg->created_at->diffForHumans() }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <button wire:click="view({{ $msg->id }})" class="text-primary-600 hover:text-primary-700 font-medium">View</button>
                            <button wire:click="delete({{ $msg->id }})" wire:confirm="Delete this message?" class="text-red-500 hover:text-red-700 font-medium">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">No messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-3 border-t border-slate-100">{{ $messages->links() }}</div>
    </div>

    {{-- Detail Modal --}}
    @if($showDetail && $viewing)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" wire:click="$set('showDetail', false)"></div>
            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">
                <h3 class="font-heading font-semibold text-lg text-slate-800 mb-1">{{ $viewing->subject ?: 'No Subject' }}</h3>
                <div class="flex items-center gap-2 text-sm text-slate-500 mb-4">
                    <span>{{ $viewing->name }}</span>
                    <span>·</span>
                    <a href="mailto:{{ $viewing->email }}" class="text-primary-600 hover:underline">{{ $viewing->email }}</a>
                    <span>·</span>
                    <span>{{ $viewing->created_at->format('M d, Y H:i') }}</span>
                </div>
                <div class="text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50 rounded-xl p-4 text-sm">{{ $viewing->message }}</div>
                <div class="flex justify-end gap-3 mt-6">
                    <a href="mailto:{{ $viewing->email }}" class="btn-outline text-sm">Reply via Email</a>
                    <button wire:click="$set('showDetail', false)" class="btn-primary text-sm">Close</button>
                </div>
            </div>
        </div>
    @endif
</div>
