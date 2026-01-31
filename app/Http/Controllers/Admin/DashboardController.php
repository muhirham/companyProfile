<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Post;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        // STAT KARTU
        $totalProducts  = Product::count();
        $totalPosts     = Post::count();
        $totalMessages  = ContactMessage::count();

        // BERITA TERBARU (urutin pakai created_at)
        $latestPosts = Post::orderByDesc('created_at')
            ->take(5)
            ->get();

        // PESAN KONTAK TERBARU
        $latestMessages = ContactMessage::orderByDesc('created_at')
            ->take(5)
            ->get();

        // JUMLAH PESAN BELUM DIBACA
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();

        return view('admin.index', compact(
            'totalProducts',
            'totalPosts',
            'totalMessages',
            'latestPosts',
            'latestMessages',
            'unreadMessagesCount'
        ));
    }
}
