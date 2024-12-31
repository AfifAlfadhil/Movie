<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil username dan password dari input
        $username = $request->input('username');
        $password = $request->input('password');

        // Cari pengguna berdasarkan username
        $user = User::where('user_name', $username)->first();

        // Cek apakah user ditemukan dan passwordnya sesuai (plain-text)
        if ($user && $user->password == $password) {
            // Jika login berhasil, login pengguna dan arahkan ke halaman yang dituju
            Auth::login($user);

            // Simpan role di session jika diperlukan
            session(['role' => $user->role_name]);

            // Redirect user ke halaman yang dituju
            return redirect()->intended('/');
        }

        // Jika login gagal, tampilkan pesan error
        return back()->withErrors(['username' => 'The provided credentials do not match our records.']);
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('role');  // Hapus session role
        return redirect('/login');
    }
}
