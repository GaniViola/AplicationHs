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
        return view('admin.login.index');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email:rcf,dns',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)) {
            
            return redirect()->intended('/dashboard');
            
        }

        // Cari user berdasarkan username
        // $user = User::where('username', $credentials['username'])->first();

        // Cek user dan password
        // if ($user && Hash::check($credentials['password'], $user->password)) {
        //     Auth::login($user);

        //     // Redirect berdasarkan role (opsional)
        //     switch ($user->role) {
        //         case 'admin':
        //             return view('admin.layouts.app');
        //         case 'worker':
        //             return redirect('/worker/home');
        //         case 'customer':
        //             return redirect('/customer/home');
        //         default:
        //             return redirect('/');
        //     }
        // }

        // Kalau gagal login
        return back()->with('loginError', 'Username atau password salah');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/secure-area/login');
    }
}
