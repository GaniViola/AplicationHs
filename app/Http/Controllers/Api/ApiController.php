<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    // 🔐 REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20', // Validasi untuk phone
            'role' => 'required|in:admin,worker,customer', // Validasi role
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'address'  => $request->address,
            'phone'    => $request->phone,  // Menambahkan phone
            'role'     => $request->role,   // Menambahkan role
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil!',
            'user'    => $user
        ], 201);
    }

    // 🔓 LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Buat token baru
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil!',
            'token'   => $token,
            'user'    => $user
        ]);
    }

    // 🔒 LOGOUT
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil!'
        ]);
    }
}
