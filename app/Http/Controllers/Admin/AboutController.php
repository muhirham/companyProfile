<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        // selalu ambil 1 data
        $profile = CompanyProfile::firstOrCreate([]);

        return view('admin.about.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = CompanyProfile::first();

        // upload gambar
        if ($request->hasFile('about_image')) {
            // hapus gambar lama
            if ($profile->about_image && Storage::disk('public')->exists($profile->about_image)) {
                Storage::disk('public')->delete($profile->about_image);
            }

            $data['about_image'] = $request
                ->file('about_image')
                ->store('about', 'public');
        }

        $profile->update($data);

        return back()->with('success', 'About Us berhasil diperbarui');
    }
}
