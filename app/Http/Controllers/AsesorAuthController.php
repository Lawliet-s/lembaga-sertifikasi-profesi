<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AsesorAuthController extends Controller
{
    /**
     * Tampilkan form login asesor
     */
    public function loginForm()
    {
        if (Auth::check() && Auth::user()->role === 'asesor') {
            return redirect()->route('dashboard.asesor');
        }
        return view('auth.loginasesor');
    }

    /**
     * Proses login asesor dengan proteksi keamanan
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4'],
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 4 karakter',
        ]);

        // Cari user dengan email dan role asesor
        $user = User::where('email', $credentials['email'])
            ->where('role', 'asesor')
            ->first();

        // Verifikasi user dan password
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            // Logging attempt yang gagal untuk deteksi brute force
            \Log::warning('Failed asesor login attempt', [
                'email' => $credentials['email'],
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now(),
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password tidak sesuai']);
        }

        // Pastikan Spatie role terpasang untuk middleware role:asesor
        if (!$user->hasRole('asesor')) {
            $user->syncRoles(['asesor']);
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));

        // Log successful login
        \Log::info('Asesor login successful', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => $request->ip(),
            'timestamp' => now(),
        ]);

        return redirect()->route('dashboard.asesor')
            ->with('success', 'Login berhasil. Selamat datang ' . $user->name);
    }

    /**
     * Logout asesor
     */
    public function logout(Request $request)
    {
        \Log::info('Asesor logout', [
            'user_id' => Auth::id(),
            'timestamp' => now(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginasesor')
            ->with('success', 'Logout berhasil');
    }
}
