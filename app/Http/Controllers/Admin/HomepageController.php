<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageService;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HomepageController extends Controller
{
    public function index()
    {
        $homepage = HomepageSetting::first();
        $services = HomepageService::all();

        return view('admin.homepage.index', [
            'title'    => 'Homepage',
            'homepage' => $homepage,
            'services' => HomepageService::where('is_active', true)->get(),
        ]);
    }

    /**
     * Update the homepage settings.
     * ini ga di pake di blade user 
     * 'hero_button_text'  => 'nullable|string|max:100',
     * 'hero_button_url'   => 'nullable|string|max:255',
     * 'highlight_title'   => 'nullable|string|max:255',
     * 'highlight_body'    => 'nullable|string',
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_title'         => 'nullable|string',
            'hero_subtitle'      => 'nullable|string',
            'years_experience'   => 'nullable|integer',
            'projects_completed' => 'nullable|integer',
            'support_service'    => 'nullable|integer',
            'hero_images.*'      => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $homepage = HomepageSetting::firstOrCreate([]);

        // ambil data lama
        $images = $homepage->hero_images ?? [];

        // kalau upload gambar baru → TAMBAH
        if ($request->hasFile('hero_images')) {
            foreach ($request->file('hero_images') as $file) {
                $images[] = [
                    'id'     => uniqid(),
                    'image'  => $file->store('hero', 'public'),
                    'active' => true,
                ];
            }
        }

        $homepage->update([
            'hero_title'         => $data['hero_title'] ?? $homepage->hero_title,
            'hero_subtitle'      => $data['hero_subtitle'] ?? $homepage->hero_subtitle,
            'years_experience'   => $data['years_experience'] ?? $homepage->years_experience,
            'projects_completed' => $data['projects_completed'] ?? $homepage->projects_completed,
            'support_service'    => $data['support_service'] ?? $homepage->support_service,
            'hero_images'        => $images,
        ]);

        return back()->with('success', 'Homepage updated');
    }

    public function deleteHeroImage(Request $request)
    {
        $homepage = HomepageSetting::first();

        $images = collect($homepage->hero_images);

        $target = $images->firstWhere('id', $request->image_id);

        // hapus file fisik
        if ($target && Storage::disk('public')->exists($target['image'])) {
            Storage::disk('public')->delete($target['image']);
        }

        // hapus dari array
        $images = $images
            ->reject(fn ($img) => $img['id'] === $request->image_id)
            ->values()
            ->toArray();

        $homepage->update(['hero_images' => $images]);

        return back()->with('success', 'Gambar berhasil dihapus');
    }


    /*    * Display a listing of the homepage services.
     */

    public function updateServices(Request $request)
    {
        $data = $request->validate([
            'services' => 'required|array',
            'services.*.title' => 'required|string',
            'services.*.subtitle' => 'nullable|string',
            'services.*.icon' => 'nullable|string',
        ]);

        foreach ($data['services'] as $id => $service) {
            HomepageService::where('id', $id)->update([
                'title' => $service['title'],
                'subtitle' => $service['subtitle'] ?? null,
                'icon' => $service['icon'] ?? null,
            ]);
        }

        return back()->with('success', 'Service homepage berhasil diupdate');
    }


}
