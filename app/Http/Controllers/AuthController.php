<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $credentials['username'])->first();

        // Cek user dan password
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            // Redirect berdasarkan role (opsional)
            switch ($user->role) {
                case 'admin':
                    return "selamat datang admiin";
                case 'worker':
                    return redirect('/worker/home');
                case 'customer':
                    return redirect('/customer/home');
                default:
                    return redirect('/');
            }
        }

        // Kalau gagal login
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/secure-area/login');
    }
}
