<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total' => Peminjaman::where('user_id', $user->id)->count(),
            'aktif' => Peminjaman::where('user_id', $user->id)
                ->whereIn('status', ['dipinjam', 'pengambilan'])->count(),
            'selesai' => Peminjaman::where('user_id', $user->id)
                ->where('status', 'kembali')->count(),
        ];

        $recentActivity = Peminjaman::with('book')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('pages.profile', compact('stats', 'recentActivity'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'no_tlp' => 'nullable|string|max:15',
        ]);

        // Hanya update field yang diizinkan
        $user->update($validated);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        // Check if old password is correct
        if (! Hash::check($validated['old_password'], $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => 'Password lama tidak sesuai.',
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
}
