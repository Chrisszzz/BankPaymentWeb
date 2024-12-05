<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Cek kredensial
        $user = User::where('nama_pengguna', $credentials['username'])->first();
        if ($user && $user->password === $credentials['password']) {
            // Login sukses: simpan user ke session
            $request->session()->put('user', $user);
            return redirect()->intended('/home');
        } else {
            // Login gagal
            return redirect('/')->withErrors(['login_error' => 'Username atau password salah']);
        }
    }
}
