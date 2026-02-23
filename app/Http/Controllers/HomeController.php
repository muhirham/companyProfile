<?php

namespace App\Http\Controllers;

use App\http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\VisionMission;
use App\Models\Gallery;
use App\Models\HomepageSetting;
use App\Models\HomepageService;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\Brand;




class HomeController extends Controller
{
    public function index()
    {
        $homepage = HomepageSetting::orderBy('id')->first();
        $services = HomepageService::where('is_active', true)
        ->orderBy('order')
        ->get();
        $visionMission = VisionMission::latest()->first();

        // HANYA gallery yang is_active = 1
        $galleries = Gallery::where('is_active', true)
            ->latest()          // kalau mau berdasarkan created_at, bisa diganti ->orderBy('id','desc')
            ->get();
        
        return view('user.home', [
            'homepage'      => $homepage,
            'services'      => $services,
            'visionMission' => $visionMission,
            'galleries'     => $galleries,

        ]);
    }

    
        public function about()
    {
        $profile = CompanyProfile::first();

        return view('user.about', [
            'profile' => $profile
        ]);
    }

    public function blog()
    {
        $posts = Post::where('status', 'published')
            ->latest()
            ->paginate(6);

        return view('user.blog', compact('posts'));
    }

    // BLOG DETAIL 
    public function blogDetail($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('user.blog-detail', compact('post'));
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function service()
    {
        $services = Service::where('is_active', 1)
            ->orderBy('id')
            ->get();

        return view('user.service', compact('services'));
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('user.service-detail', compact('service'));
    }

    public function genset()
{
    $brands = Brand::where('is_active', true)->get();
    return view('user.genset', compact('brands'));
}

public function gensetDetail($slug)
{
    $brand = Brand::where('slug', $slug)
        ->with('specs')
        ->firstOrFail();

    return view('user.genset-detail', compact('brand'));
}




}
