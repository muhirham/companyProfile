<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderByDesc('created_at')->get();

        return view('admin.messages.index', [
            'title'    => 'Pesan Kontak',
            'messages' => $messages,
        ]);
    }
}
