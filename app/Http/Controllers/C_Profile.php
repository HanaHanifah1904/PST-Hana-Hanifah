<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Dokumentasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class C_Profile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Halaman profile dengan dokumentasi
    public function index()
    {
        $user = Auth::user();
        $dokumentasi = M_Dokumentasi::all(); // ambil semua dokumentasi

        return view('v_profile', compact('user', 'dokumentasi'));
    }

    // Form edit profile
    public function edit()
    {
        $user = Auth::user();
        return view('v_profiledashboard', compact('user'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|unique:tb_user,username,' . $user->id,
            'password' => 'nullable|string|confirmed|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->username = $request->username;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename);

            if ($user->foto && file_exists(public_path('assets/img/' . $user->foto))) {
                unlink(public_path('assets/img/' . $user->foto));
            }

            $user->foto = $filename;
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile berhasil diperbarui!');
    }
}
