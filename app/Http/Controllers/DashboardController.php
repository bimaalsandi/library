<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pengunjung;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $buku = Buku::count();
        $pengunjung = Pengunjung::count();
        $bukuModel = new Buku();
        $totalBuku = $bukuModel->totalBukuPerBulan();

        $pengunjungModel = new Pengunjung();
        $totalPengunjungPerBulan = $pengunjungModel->totalPengunjungPerBulan();

        $data = [
            'title' => 'Dashboard - Sistem Perpustakaan',
            'active' => 'dashboard',
            'user' => $user,
            'buku' => $buku,
            'pengunjung' => $pengunjung,
            'totalBuku' => $totalBuku,
            'totalPengunjungPerBulan' => $totalPengunjungPerBulan,
        ];
        return view('dashboard', $data);
    }

    public function indexMember(Request $request)
    {
        $search = $request->input('search');
        $bukuModel = new Buku();
        $pengunjungModel = new Pengunjung();
        $buku = $bukuModel->getAllBuku($search);
        foreach ($buku as $b) {
            $b->status = Pengunjung::where('id_user', Auth::id())->where('id_buku', $b->id)->value('status');
        }



        $data = [
            'title' => 'Dashboard - Sistem Perpustakaan',
            'active' => 'dashboard',
            'buku' => $buku
        ];
        return view('dashboard-member', $data);
    }
}
