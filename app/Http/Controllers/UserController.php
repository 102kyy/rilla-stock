<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AkunPegawaiBaru;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $pegawais = User::orderBy('id', 'desc')->get();
        
        return view('management-usr.index', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'string', Rule::in(['admin', 'pegawai'])],
        ]);

        $passwordAcak = Str::random(8);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($passwordAcak),
        ]);

        try {
            Mail::to($user->email)->send(new AkunPegawaiBaru($user, $passwordAcak));
            $pesanSukses = 'Pegawai baru berhasil didaftarkan dan detail login telah dikirim ke email mereka.';
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email pegawai baru: ' . $e->getMessage());
            
            $pesanSukses = 'Pegawai berhasil didaftarkan, namun email gagal dikirim. Password acak mereka: ' . $passwordAcak;
        }

        return redirect()->route('user.index')->with('success', $pesanSukses);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', Rule::in(['admin', 'pegawai'])],
        ]);

        if (Auth::id() === $user->id && $request->role !== 'admin') {
            return redirect()->back()->with('error', 'Kamu tidak bisa menurunkan tingkat hak akses akunmu sendiri!');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'Data pengenal dan hak akses pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri!');
        }
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Akun dengan tingkat akses Admin tidak diperbolehkan untuk dihapus!');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}