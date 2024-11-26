<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //registrasi akun controller
    public function register()
    {
        return view('layouts.register');
    }
    public function registrasiAkun(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        $user->save();
        return back()->with('success', 'Registrasi Akun Berhasil');
    }
    // login controller
    public function login()
    {
        return view('layouts.login');
    }
    public function loginAuth(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $user = User::where('email', $request->email)->first();
        if ($user && $user->status == 0) {
            return back()->withErrors(['status' => 'Maaf, akun Anda tidak aktif.']);
        }
        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Login Berhasil Selamat Datang Di Sistem Project');
        }
        return back()->withErrors(['username' => 'Email atau Password Salah']);
    }
    //logout controller
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
