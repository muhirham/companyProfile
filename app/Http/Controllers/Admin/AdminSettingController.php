<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.user_admin');
    }

public function update(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'current_password' => 'required',
        'new_password' => 'nullable|min:6|confirmed'
    ], [
        'new_password.confirmed' => 'Konfirmasi password baru tidak sama.',
        'new_password.min' => 'Password minimal 6 karakter.'
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors([
            'current_password' => 'Password lama salah.'
        ])->withInput();
    }

    $user->email = $request->email;

    if ($request->filled('new_password')) {
        $user->password = Hash::make($request->new_password);
    }

    $user->save();

    return back()->with('success', 'Account berhasil diupdate.');
}
}