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

    public function profile()
    {
        $data = [
            'title' => 'Profile - Sistem Perpustakaan',
            'active' => 'profile',
            'user' => Auth::user()
        ];
        return view('auth.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email, ' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile berhasil diupdate');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }
}
