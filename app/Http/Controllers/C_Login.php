<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Password;


class C_Login extends Controller
{

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:tb_user,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    // 🔹 Tampilkan halaman login
    public function showLogin()
    {
        return view('v_login');
    }

    // 🔹 Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Rate limiter
        $throttleKey = Str::lower($request->username) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'username' => "Terlalu banyak percobaan login. Coba lagi dalam $seconds detik."
            ]);
        }

        // Ambil user
        $user = M_User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            RateLimiter::hit($throttleKey, 60);
            return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
        }

        // Rehash password jika perlu
        if (Hash::needsRehash($user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Login
        Auth::login($user);
        $request->session()->regenerate();
        RateLimiter::clear($throttleKey);

        return redirect()->route('profile'); // arahkan setelah login
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // 🔹 Tampilkan halaman register
    public function showRegister()
    {
        return view('v_register');
    }

    // 🔹 Proses register
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:tb_user,username',
            'email' => 'required|email|unique:tb_user,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        M_User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function showForgotForm()
    {
        return view('v_forgot-password');
    }

    // Tampilkan form reset password
    public function showResetForm($token)
    {
        return view('v_forgot-password', ['token' => $token]);
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:tb_user,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
