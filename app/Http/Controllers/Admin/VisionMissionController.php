<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    /**
     * Tampilkan form edit (sekalian create kalau belum ada data).
     */
    public function edit()
    {
        // selalu ambil record pertama; kalau belum ada, buat kosong
        $vm = VisionMission::first();

        if (!$vm) {
            $vm = VisionMission::create([
                'vision'  => '',
                'mission' => '',
            ]);
        }

        return view('admin.visimisi.index', [
            'vm' => $vm,
        ]);
    }

    /**
     * Update visi & misi (single record).
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'vision'  => 'required|string',
            'mission' => 'required|string',
        ]);

        $vm = VisionMission::first();

        if (!$vm) {
            $vm = VisionMission::create($data);
        } else {
            $vm->update($data);
        }

        return redirect()
            ->route('admin.vision-mission.edit')
            ->with('success', 'Visi & Misi berhasil diperbarui.');
    }
}

