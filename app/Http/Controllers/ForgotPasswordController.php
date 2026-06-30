<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]
        );

        try {
            Mail::to($request->email)->send(new ResetPasswordMail($token, $request->email));
            return back()->with('status', 'Kami telah mengirimkan link reset password ke email kamu!');
        } catch (\Exception $e) {
            Log::error('Gagal kirim email reset password: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim email, coba lagi nanti.');
        }
    }

    public function showResetForm($token, Request $request)
    {
        $email = $request->query('email');
        return view('auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        // Validasi token kustom
        if (!$record || $record->token !== $request->token) {
            return back()->with('error', 'Token reset password tidak valid atau sudah kedaluwarsa.');
        }

        User::query()->where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus token yang sudah terpakai
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password kamu berhasil diperbarui! Silakan login dengan password baru.');
    }
}