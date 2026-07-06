<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120',
        ]);

        $path = $request->file('file')->store('trix-images', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }

    public function removeImage(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        $relativePath = str_replace(asset('storage/'), '', $request->path);

        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }

        return response()->json(['success' => true]);
    }
}
