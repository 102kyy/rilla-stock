<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        // Validasi input form sandi dengan error bag 'updatePassword' sesuai template Blade kamu
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'], // Memvalidasi apakah sandi lama cocok
            'password' => ['required', Password::defaults(), 'confirmed'], // Memvalidasi sandi baru minimal 8 karakter & harus klop dengan konfirmasi
        ], [
            'current_password.current_password' => 'Kata sandi saat ini yang kamu masukkan salah.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
        ]);

        // Update password baru yang sudah di-hash otomatis ke database
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Kembali ke halaman profile dengan status sukses
        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user instanceof User) {
            Auth::logout();
            User::destroy($user->id);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}