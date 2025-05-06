<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function checkEmail(Request $request)
    {
        // Ambil email dari input
        $email = $request->input('email');

        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        if ($user) {
            // Jika user ditemukan
            return response()->json(['status' => 'success']);
        } else {
            // Jika user tidak ditemukan
            return response()->json(['status' => 'error', 'message' => 'Email tidak ditemukan']);
        }
    }

    public function sendOtp(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Email tidak terdaftar']);
        }

        $otp = rand(100000, 999999); // hanya angka 6 digit
        try {
            Mail::to($email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            Log::error('Gagal kirim OTP: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal mengirim email OTP']);
        }

        $user->otp = $otp;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'OTP telah dikirim',
            'otp' => $otp // <-- INI YANG BETUL
        ]);
    }

    public function ubahpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak ditemukan'
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null; // Pastikan kolom ini nullable di database
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah'
        ]);
    }

}
