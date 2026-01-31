<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CompanyValueController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\HomeController;




Route::get('/admin', function () {
    return redirect()->route('admin.index');
});

Route::get('/', function () {
    return view('user.index');
});

Route::get('/homee', function () {return view('user.home');});
Route::get('/about', function () {return view('user.about');});
Route::get('/blog', function () {return view('user.blog');});
Route::get('/blog-detail', function () {return view('user.blog-detail');});
Route::get('/contact', function () {return view('user.contact');});
Route::get('/service', function () {return view('user.service');});
Route::get('/service-detail', function () {return view('user.service-detail');});
Route::get('/genset', function () {return view('user.genset');});
Route::get('/genset-detail', function () {return view('user.genset-detail');});


Route::get('/', [HomeController::class, 'index'])->name('home');

// GROUP ADMIN (belum pakai auth dulu)
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/index', [DashboardController::class, 'index'])
        ->name('index');

    Route::get('/homepage', [HomepageController::class, 'index'])
        ->name('homepage.index');

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');
    
    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
        
        Route::resource('gallery', GalleryController::class)->except(['create', 'edit']);
        Route::resource('posts', PostController::class)->except(['create', 'edit']);

        Route::get('vision-mission', [VisionMissionController::class, 'edit'])->name('vision-mission.edit');
        Route::put('vision-mission', [VisionMissionController::class, 'update'])->name('vision-mission.update');

        Route::resource('values', CompanyValueController::class)->names('values')->except(['create', 'edit']);

        Route::resource('about', AboutController::class)->only(['index', 'update'])->parameters(['about' => 'profile', ]);

});
