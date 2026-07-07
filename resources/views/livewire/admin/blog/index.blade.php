<div>
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
    <h2 class="text-lg font-heading font-semibold text-slate-800">Blog Posts</h2>
    <div class="flex items-center gap-3">
      <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search Blog..."
        class="px-4 py-2 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm w-48">
      <a href="{{ route('admin.blogs.create') }}" wire:navigate class="btn-primary text-sm">+ Add Blog Post</a>
    </div>
  </div>

  <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50 border-b border-slate-100">
        <tr>
          <th class="px-4 py-3 text-left font-medium text-slate-600">#</th>
          <th class="px-4 py-3 text-left font-medium text-slate-600">Title</th>
          <th class="px-4 py-3 text-left font-medium text-slate-600 hidden md:table-cell">Category</th>
          <th class="px-4 py-3 text-left font-medium text-slate-600 hidden md:table-cell">Author</th>
          <th class="px-4 py-3 text-right font-medium text-slate-600">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse($blogs as $post)
          <tr class="hover:bg-slate-50/50">
            <td class="px-4 py-3 text-slate-500">
              {{ ($blogs->currentPage() - 1) * $blogs->perPage() + $loop->iteration }}
            </td>
            <td class="px-4 py-3">
              <div class="flex items-center gap-3">
                @if ($post->thumbnail)
                  <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-10 h-10 rounded-lg object-cover">
                @endif
                <span class="font-medium text-slate-800">{{ $post->title }}</span>
              </div>
            </td>
            <td class="px-4 py-3 text-slate-500 hidden md:table-cell">
              {{ $post->category->name ?? '-' }}
            </td>
            <td class="px-4 py-3 text-slate-500 hidden md:table-cell">
              {{ $post->author->name ?? '-' }}
            </td>
            <td class="px-4 py-3 text-right space-x-2">
              <a href="{{ route('admin.blogs.edit', $post) }}" wire:navigate
                class="text-primary-600 hover:text-primary-700 font-medium">Edit</a>
              <button wire:click="delete({{ $post->id }})" wire:confirm="Delete this post?"
                class="text-red-500 hover:text-red-700 font-medium">Delete</button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-4 py-8 text-center text-slate-500">No blog posts yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="px-6 py-3 border-t border-slate-100">{{ $blogs->links() }}</div>
  </div>
</div>
