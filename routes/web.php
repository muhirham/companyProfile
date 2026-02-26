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
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\GensetInquiryController;
use App\Http\Controllers\HomeController;




Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/blog', [HomeController::class, 'blog'])
    ->name('blog');

Route::get('/blog/{post:slug}', [HomeController::class, 'blogDetail'])
    ->name('blog-detail');

Route::get('/contact', [HomeController::class, 'contact'])
    ->name('contact');

Route::post('/contact', [HomeController::class, 'contactStore'])
    ->name('contact.store');


Route::get('/service', [HomeController::class, 'service'])
    ->name('service');

Route::get('/service/{slug}', [HomeController::class, 'serviceDetail'])
    ->name('service.detail');

Route::get('/genset/{brand}/download-pdf',[HomeController::class, 'downloadGensetPdf']
)->name('genset.download.pdf');

Route::get('/genset', [HomeController::class, 'genset'])
    ->name('user.genset');
Route::get('/genset/{slug}', [HomeController::class, 'gensetDetail'])
    ->name('user.genset.detail');

Route::get('/genset/{brandSlug}/{modelSlug}',[HomeController::class, 'detailModel'])
    ->name('user.genset.model.detail');

Route::post('/genset-inquiry',[HomeController::class, 'store'])
    ->name('genset.inquiry.store');

Route::get('/genset-specs/{brand}',[HomeController::class, 'getSpecsByBrand'])
    ->name('genset.specs.by.brand');




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

    Route::post('/messages/read/{id}', [ContactMessageController::class, 'markRead']);
    
    Route::delete('/messages/{id}', [ContactMessageController::class, 'destroy']);

    Route::get('/service', [ServiceController::class, 'index'])
        ->name('service.index');

    Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])
        ->name('service.edit');

    Route::put('/service/{id}', [ServiceController::class, 'update'])
        ->name('service.update');

     Route::get('/genset', [ProductController::class, 'index'])
        ->name('genset.index');

    Route::post('/genset/brand', [ProductController::class, 'storeBrand'])
        ->name('genset.storeBrand');

    Route::put('/genset/brand/{id}', [ProductController::class, 'updateBrand'])
        ->name('genset.updateBrand');

    Route::post('/genset/brand/store',[ProductController::class,'storeBrand'])
       ->name('genset.storeBrand');

    Route::delete('/genset/brand/{id}',[ProductController::class,'deleteBrand'])
       ->name('genset.deleteBrand');

    Route::post('/genset/spec', [ProductController::class, 'storeSpec'])
        ->name('genset.storeSpec');

    Route::put('/genset/spec/{id}', [ProductController::class, 'updateSpec'])
        ->name('genset.updateSpec');

    Route::delete('/genset/spec/{id}', [ProductController::class, 'deleteSpec'])
        ->name('genset.deleteSpec');

    Route::put('/admin/homepage', [HomepageController::class, 'update'])
        ->name('homepage.update');


    Route::delete('/homepage/hero-image', [HomepageController::class, 'deleteHeroImage'])
        ->name('homepage.hero.delete');
    
    Route::get('/homepage/services',[HomepageController::class, 'services'])
        ->name('homepage.services');

    Route::put('/homepage/services',[HomepageController::class, 'updateServices'])
        ->name('homepage.services.update');



    Route::get('/requests',[GensetInquiryController::class, 'index'])
        ->name('requests.index');

    Route::get('/requests/{inquiry}',[GensetInquiryController::class, 'show']);

    Route::delete('/requests/{inquiry}',[GensetInquiryController::class, 'destroy']);


        

        Route::resource('posts', PostController::class)->except(['create', 'edit']);

        Route::get('vision-mission', [VisionMissionController::class, 'edit'])->name('vision-mission.edit');
        Route::put('vision-mission', [VisionMissionController::class, 'update'])->name('vision-mission.update');

        Route::resource('values', CompanyValueController::class)->names('values')->except(['create', 'edit']);

        Route::resource('about', AboutController::class)->only(['index', 'update'])->parameters(['about' => 'profile', ]);

});
