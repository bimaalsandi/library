<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $data = [
            'user' => $user,
            'title' => 'User - Sistem Perpustakaan',
            'active' => 'user'
        ];
        return view('user.index', $data);
    }
}
