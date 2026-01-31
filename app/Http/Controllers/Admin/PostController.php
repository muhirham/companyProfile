<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return view('admin.posts.index', compact('posts'));
    }

    // dipakai buat ambil data waktu klik "Detail" / "Edit" (AJAX GET)
    public function show(Post $post)
    {
        return response()->json([
            'success' => true,
            'post' => [
                'id'         => $post->id,
                'title'      => $post->title,
                'slug'       => $post->slug,
                'excerpt'    => $post->excerpt,
                'body'       => $post->body,
                'status'     => $post->status,
                'image_url'  => $post->image_path
                    ? asset('storage/' . $post->image_path)
                    : asset('compe/imgExample/images.png'),
                'created_at' => $post->created_at
                    ? $post->created_at->format('d-m-Y H:i')
                    : null,
                'updated_at' => $post->updated_at
                    ? $post->updated_at->format('d-m-Y H:i')
                    : null,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($data);

        return response()->json([
            'success' => true,
            'post' => [
                'id'         => $post->id,
                'title'      => $post->title,
                'status'     => $post->status,
                'created_at' => $post->created_at
                    ? $post->created_at->format('d-m-Y')
                    : null,
                'image_url'  => $post->image_path
                    ? asset('storage/' . $post->image_path)
                    : asset('compe/imgExample/images.png'),
            ],
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validateRequest($request, $post->id);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('image')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return response()->json([
            'success' => true,
            'post' => [
                'id'         => $post->id,
                'title'      => $post->title,
                'status'     => $post->status,
                'created_at' => $post->created_at
                    ? $post->created_at->format('d-m-Y')
                    : null,
                'image_url'  => $post->image_path
                    ? asset('storage/' . $post->image_path)
                    : asset('compe/imgExample/images.png'),
            ],
        ]);
    }

    public function destroy(Post $post)
    {
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return response()->json(['success' => true]);
    }

    protected function validateRequest(Request $request, $ignoreId = null)
    {
        $slugRule = 'nullable|string|max:255|unique:posts,slug';
        if ($ignoreId) {
            $slugRule .= ',' . $ignoreId;
        }

        return $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => $slugRule,
            'excerpt' => 'nullable|string',
            'body'    => 'required|string',
            'status'  => 'required|in:draft,published',
            'image'   => 'nullable|image|max:2048',
        ]);
    }
}
