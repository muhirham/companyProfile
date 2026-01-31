<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;

class HomepageController extends Controller
{
    public function index()
    {
        $homepage = HomepageSetting::first();

        return view('admin.homepage.index', [
            'title'    => 'Homepage',
            'homepage' => $homepage,
        ]);
    }
}
