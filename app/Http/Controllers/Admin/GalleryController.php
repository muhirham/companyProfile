<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();

        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        try {
            // validasi multiple file
            $request->validate([
                'images'   => 'required',
                'images.*' => 'image|max:2048',
            ]);

            if (!$request->hasFile('images')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada file yang di-upload',
                ], 422);
            }

            $files = $request->file('images');
            // kalau cuma 1 file, jadikan array
            if (!is_array($files)) {
                $files = [$files];
            }

            $items = [];

            foreach ($files as $file) {
                $path  = $file->store('gallery', 'public');
                $title = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                $gallery = Gallery::create([
                    'title'      => $title,
                    'image_path' => $path,
                    'is_active'  => true,
                ]);

                $items[] = $this->transform($gallery);
            }

            return response()->json([
                'success' => true,
                'items'   => $items,
            ]);
        } catch (\Throwable $e) {
            // sementara kirim pesan error biar keliatan kalau masih ada masalah lain
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Gallery $gallery)
    {
        return response()->json([
            'success' => true,
            'gallery' => $this->transform($gallery),
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title'     => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'image'     => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return response()->json([
            'success' => true,
            'gallery' => $this->transform($gallery->fresh()),
        ]);
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return response()->json(['success' => true]);
    }

    protected function transform(Gallery $g): array
    {
        return [
            'id'         => $g->id,
            'title'      => $g->title,
            'is_active'  => (bool) $g->is_active,
            'image_url'  => $g->image_path
                ? asset('storage/' . $g->image_path)
                : null,
            'created_at' => optional($g->created_at)->format('d-m-Y'),
            'updated_at' => optional($g->updated_at)->format('d-m-Y'),
        ];
    }
}
