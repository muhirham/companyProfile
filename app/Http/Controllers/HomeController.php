<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\CompanyValue;
use App\Models\VisionMission;
use App\Models\Gallery;
use App\Models\HomepageSetting;

class HomeController extends Controller
{
    public function index()
    {
        $homepage = HomepageSetting::orderBy('id')->first();
        $company       = CompanyProfile::first();
        $services      = CompanyValue::orderBy('order')->get();
        $visionMission = VisionMission::latest()->first();

        // HANYA gallery yang is_active = 1
        $galleries = Gallery::where('is_active', true)
            ->latest()          // kalau mau berdasarkan created_at, bisa diganti ->orderBy('id','desc')
            ->get();

        return view('user.home', [
            'homepage'      => $homepage,
            'company'       => $company,
            'services'      => $services,
            'visionMission' => $visionMission,
            'galleries'     => $galleries,
        ]);
    }
}
