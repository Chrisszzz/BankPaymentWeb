<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email'=>$request->username,'password'=>$request->password])) {
            return response()->json([
                'status' => 'true',
                'title'=>'Login Berhasil',
                'message'=>'Login berhasil, selamat beraktivitas !!',
                'url'=>route('index.home')
            ]);
        }else{
            return response()->json([
                'status' => 'false',
                'title'=>'Login Gagal',
                'message'=>'Username/Password yang anda masukkan tidak sesuai.'
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
