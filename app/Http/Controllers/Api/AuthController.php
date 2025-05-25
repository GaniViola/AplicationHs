<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Exception;

class AuthController extends Controller
{
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak ditemukan'
            ]);
        }
    }

    public function sendOtp(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak terdaftar'
            ]);
        }

        $otp = rand(100000, 999999);

        try {
            Mail::to($email)->send(new OtpMail($otp));
        } catch (Exception $e) {
            Log::error('Gagal kirim OTP: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim email OTP'
            ]);
        }

        $user->otp = $otp;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'OTP telah dikirim',
            'otp' => $otp // Sebaiknya hilangkan ini di production demi keamanan
        ]);
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak ditemukan'
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah'
        ]);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'message' => 'Password lama salah!'
            ], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Password berhasil diubah.'
        ], 200);
    }

    public function uploadProfilePhoto(Request $request)
    {
        try {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'user_id' => 'required|integer'
            ]);

            $user = User::findOrFail($request->user_id);

            if ($request->hasFile('photo')) {
                // Hapus foto lama jika ada
                if ($user->photo) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $user->photo));
                }

                // Simpan foto baru
                $path = $request->file('photo')->store('profile_photos', 'public');
                $url = Storage::url($path);

                // Update user
                $user->photo = $url;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Foto profil berhasil diupload',
                    'photo_url' => asset($url)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Tidak ada file yang diupload'
            ], 400);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload foto: ' . $e->getMessage()
            ], 500);
        }
    }
}
