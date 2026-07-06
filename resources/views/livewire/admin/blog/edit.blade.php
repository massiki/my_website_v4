<div>
  <div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-4">
      <a href="{{ route('admin.blogs') }}" wire:navigate
        class="p-2 rounded-xl text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7" />
        </svg>
      </a>
      <div>
        <h2 class="text-lg font-heading font-semibold text-slate-800">Edit Blog Post</h2>
        <p class="text-sm text-slate-500 mt-0.5">Update your blog article</p>
      </div>
    </div>
  </div>

  <form wire:submit="update">
    <div class="space-y-6">
      {{-- Main Content Card --}}
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
        <h3 class="font-heading font-semibold text-slate-800 mb-5">Article Details</h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
          {{-- Title --}}
          <div class="lg:col-span-2">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Title <span
                class="text-red-400">*</span></label>
            <input wire:model="title" type="text" placeholder="Enter blog post title"
              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm transition-all">
            @error('title')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Category --}}
          <div class="lg:col-span-2">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Category</label>
            <select wire:model="blog_category_id"
              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm transition-all">
              <option value="">— Select Category —</option>
              @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
              @endforeach
            </select>
            @error('blog_category_id')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Status --}}
          <div class="lg:col-span-2">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
            <select wire:model.live="status"
              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm transition-all">
              <option value="draft">Draft</option>
              <option value="published">Published</option>
            </select>
            @error('status')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Meta Description --}}
          <div class="lg:col-span-2">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Meta Description</label>
            <textarea wire:model="meta_description" rows="2" placeholder="Brief description for SEO (max 255 characters)"
              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-100 outline-none text-sm resize-none transition-all"></textarea>
            @error('meta_description')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      {{-- Content Card with Trix --}}
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
        <h3 class="font-heading font-semibold text-slate-800 mb-1">Content <span class="text-red-400">*</span></h3>
        <p class="text-sm text-slate-500 mb-4">Write your article content using the rich editor below</p>

        <div wire:ignore>
          <input id="trix-content" type="hidden" value="">
          <trix-editor x-data x-init="
              $el.addEventListener('trix-change', function(e) {
                  $wire.set('content', e.target.value);
              });
              if ($wire.content) {
                  $el.editor.loadHTML($wire.content);
              }
          " input="trix-content" class="trix-content min-h-[400px]"
            placeholder="Start writing..."></trix-editor>
        </div>
        @error('content')
          <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>

      {{-- Thumbnail Card --}}
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
        <h3 class="font-heading font-semibold text-slate-800 mb-1">Thumbnail</h3>
        <p class="text-sm text-slate-500 mb-4">Upload a featured image for this blog post (max 2MB)</p>

        <div class="flex items-start gap-6">
          <div class="max-w-sm">
            <label
              class="flex flex-col items-center justify-center w-full h-40 rounded-xl border-2 border-dashed border-slate-200 cursor-pointer hover:border-primary-400 hover:bg-primary-50/30 transition-all p-4">
              <svg class="w-8 h-8 text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <span class="text-sm text-slate-500">
                <span class="text-primary-600 font-medium">Click to upload</span> or drag and drop
              </span>
              <span class="text-xs text-slate-400 mt-1">PNG, JPG, WebP</span>
              <input wire:model="thumbnail" type="file" accept="image/png,image/jpeg,image/webp" class="hidden">
            </label>
            @error('thumbnail')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          @if ($thumbnailPreview)
            <div class="relative w-32 h-32 sm:w-36 sm:h-36 rounded-xl overflow-hidden border border-slate-200 shrink-0">
              <img src="{{ $thumbnailPreview }}" alt="Preview" class="w-full h-full object-cover">
              <button type="button" wire:click="removeThumbnail"
                class="absolute top-2 right-2 p-1 rounded-full bg-white/90 text-slate-600 hover:bg-red-50 hover:text-red-500 shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          @elseif ($existingThumbnail)
            <div class="relative w-32 h-32 sm:w-36 sm:h-36 rounded-xl overflow-hidden border border-slate-200 shrink-0">
              <img src="{{ asset('storage/' . $existingThumbnail) }}" alt="Current thumbnail" class="w-full h-full object-cover">
              <button type="button" wire:click="removeThumbnail"
                class="absolute top-2 right-2 p-1 rounded-full bg-white/90 text-slate-600 hover:bg-red-50 hover:text-red-500 shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          @endif
        </div>
      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.blogs') }}" wire:navigate
          class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
          Cancel
        </a>
        <button type="submit" class="btn-primary text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 13l4 4L19 7" />
          </svg>
          Update Article
        </button>
      </div>
    </div>
  </form>
</div>

<script>
  // ============================
  // Trix Editor: Upload Gambar
  // ============================
  // Saat user menyisipkan gambar di Trix Editor,
  // gambar akan di-upload ke server via AJAX.

  // event trix-attachment-add terjadi ketika ada file yang di upload
  document.addEventListener('trix-attachment-add', function(event) {
    // event.attachment berisi object attechment dari trix 
    var attachment = event.attachment;

    // apakah ada file?
    if (attachment.file) {
      // Buat FormData untuk upload
      var formData = new FormData();
      // tambahkan formData dengan key dan value
      formData.append('file', attachment.file);

      // Kirim via fetch API
      fetch('{{ route('admin.upload-image') }}', {
          // method post karena mengirim data file
          method: 'POST',
          // CSRF token, token diambil dari tag head pada layout
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          // body ini yang akan di kirim ke server
          body: formData
        })
        // respone dari server diubah menjadi json
        .then(response => response.json())
        // data berisi response json
        .then(data => {
          // apakah ada data url
          if (data.url) {
            // Set URL gambar ke Trix attachment
            attachment.setAttributes({
              url: data.url,
              href: data.url
            });
          }
        })
        .catch(error => {
          console.error('Upload gagal:', error);
          attachment.remove();
          alert('Gagal mengupload gambar. Silakan coba lagi.');
        });
    }
  });

  // event ini terjadi ketika mengklik tombol "X" untuk ngeremove gambar
  document.addEventListener("trix-attachment-remove", function(event) {
    // Ambil attachment dari event
    var attachment = event.attachment;
    // Dapatkan attachement file_path dari response upload
    var path = attachment.getAttributes().url;
    // Kalau ada file_path, kirim request ke server untuk hapus
    if (path) {
      fetch('{{ route('admin.remove-image') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({
            path: path
          })
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
        })
        .catch(error => {
          console.error('Gagal menghapus gambar:', error);
        });
    }
  });
</script>
