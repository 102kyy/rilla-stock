<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua user selain sistem internal jika ada, diurutkan paling baru
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

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make('password123'), // Password default awal pegawai
        ]);

        return redirect()->route('user.index')->with('success', 'Pegawai baru berhasil didaftarkan dengan password default: password123');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', Rule::in(['admin', 'pegawai'])],
        ]);

        // Proteksi menggunakan Auth::id() agar tidak merah di editor
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

        // Proteksi menggunakan Auth::id()
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri!');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}