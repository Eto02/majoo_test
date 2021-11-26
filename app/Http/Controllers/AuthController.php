<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/produk');
        }

        return back()->withErrors([
            'email' => 'Email tidak ditemukan dalam daftar user',
        ]);
    }
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'unique:users'],
            'password' => ['required'],
            'name' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->back();
        }
        return back()->withErrors([
            'massage' => 'Gagal meperoses data',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
