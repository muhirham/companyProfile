<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;


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

    public function markRead($id)
    {
        ContactMessage::where('id', $id)->update([
            'is_read' => true
        ]);

        return response()->json(['success' => true]);
    }

        public function destroy($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }


}
