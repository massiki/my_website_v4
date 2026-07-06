<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Manage Blogs')]
class ManageBlogs extends Component
{
  use WithPagination;

  public function delete(Blog $blog)
  {
    // Hapus thumbnail file bila ada
    if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
      Storage::disk('public')->delete($blog->thumbnail);
    }

    // Hapus gambar-gambar di konten trix (dari storage)
    if ($blog->content) {
      // Regex dapat mencari tag <img ... src="..."> di konten HTML
      preg_match_all('/<img[^>]+src="([^">]+)"/i', $blog->content, $matches);
      if (!empty($matches[1])) {
        foreach ($matches[1] as $imgUrl) {
          // Pastikan hanya link file di storage saja yang dihapus
          $storagePath = parse_url($imgUrl, PHP_URL_PATH);
          $storagePrefix = '/storage/';
          if (strpos($storagePath, $storagePrefix) === 0) {
            // Take actual path after /storage/
            $relativePath = ltrim(substr($storagePath, strlen($storagePrefix)), '/');
            if (Storage::disk('public')->exists($relativePath)) {
              Storage::disk('public')->delete($relativePath);
            }
          }
        }
      }
    }

    session()->flash('success', 'Blog post deleted!');
    $blog->delete();
  }

  public function render()
  {
    $blogs = Blog::latest('id')->paginate(10);
    // dd($blogs);
    return view('livewire.admin.blog.index', compact('blogs'));
  }
}
