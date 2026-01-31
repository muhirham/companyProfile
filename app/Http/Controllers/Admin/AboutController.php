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
        // Kalau belum ada, otomatis bikin 1 data default
        $profile = CompanyProfile::firstOrCreate([], [
            'company_name'      => 'PT Contoh Genset Indonesia',
            'tagline'           => 'Solusi Kelistrikan Andal untuk Industri dan Event Anda',
            'short_description' => 'Perusahaan yang bergerak di bidang penyediaan solusi kelistrikan melalui penjualan dan penyewaan genset.',
            'description'       => 'PT Contoh Genset Indonesia melayani kebutuhan genset untuk berbagai sektor industri, komersial, dan event.',
            'about_image'       => null,
            'address'           => 'Jl. Contoh Raya No. 123, Jakarta Selatan',
            'phone'             => '021-1234567',
            'email'             => 'info@contohgenset.co.id',
            'website'           => 'https://www.contohgenset.co.id',
            'facebook_url'      => null,
            'instagram_url'     => null,
            'linkedin_url'      => null,
            'youtube_url'       => null,
            'map_embed_url'     => null,
        ]);

        return view('admin.about.index', [
            'title'   => 'About Us',
            'profile' => $profile,
        ]);
    }

    public function update(Request $request, CompanyProfile $profile)
    {
        $data = $request->validate([
            'company_name'      => 'required|string|max:255',
            'tagline'           => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'address'           => 'nullable|string',
            'phone'             => 'nullable|string|max:50',
            'email'             => 'nullable|email|max:255',
            'website'           => 'nullable|url|max:255',
            'facebook_url'      => 'nullable|url|max:255',
            'instagram_url'     => 'nullable|url|max:255',
            'linkedin_url'      => 'nullable|url|max:255',
            'youtube_url'       => 'nullable|url|max:255',
            'map_embed_url'     => 'nullable|string',
            'about_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // handle upload gambar
        if ($request->hasFile('about_image')) {
            // hapus gambar lama kalau ada
            if ($profile->about_image && Storage::disk('public')->exists($profile->about_image)) {
                Storage::disk('public')->delete($profile->about_image);
            }

            $path = $request->file('about_image')->store('company', 'public');
            $data['about_image'] = $path;
        }

        $profile->update($data);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
