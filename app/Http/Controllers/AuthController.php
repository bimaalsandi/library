<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Form Login - Sistem Perpustakaan',
        ];
        return view('auth.login', $data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();

            if ($user->role == 'admin') {
                return redirect('/dashboard');
            } else if ($user->role == 'member') {
                return redirect('/dashboard-member');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        $data = [
            'title' => 'Form Register - Sistem Perpustakaan',
        ];
        return view('auth.register', $data);
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'member';
        $user->save();

        return redirect('/')->with('success', 'Akun sudah terdaftar silahkan login');
    }
}
