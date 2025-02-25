<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    public function updatePassword(Request $request)
    {
        // Debug apakah request diterima
        Log::info('Data request:', $request->all());

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Ambil user dengan metode yang pasti ada
        $user = User::find(Auth::id());

        if (!$user) {
            return back()->withErrors(['user' => 'User tidak ditemukan atau belum login.']);
        }

        // Periksa password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save(); // Seharusnya tidak error lagi

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
