<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthImageController extends Controller
{
    public function index()
    {
        $images = [
            'login_admin' => 'assets/images/auth/login_admin.png',
            'login_asesi' => 'assets/images/auth/login_asesi.png',
            'register' => 'assets/images/auth/register.jpg',
        ];
        return view('admin.auth_images.index', compact('images'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'login_admin' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'login_asesi' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'register' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $targetDir = public_path('assets/images/auth');

        if ($request->hasFile('login_admin')) {
            $request->file('login_admin')->move($targetDir, 'login_admin.png');
        }

        if ($request->hasFile('login_asesi')) {
            $request->file('login_asesi')->move($targetDir, 'login_asesi.png');
        }

        if ($request->hasFile('register')) {
            $request->file('register')->move($targetDir, 'register.jpg');
        }

        return redirect()->route('auth.images.index')->with('success', 'Gambar halaman auth berhasil diperbarui.');
    }
}
