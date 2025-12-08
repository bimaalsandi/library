<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pengunjung;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $dateRange = $request->input('daterange', '');
        if (!empty($dateRange)) {
            list($startDate, $endDate) = array_map('trim', explode(' - ', $dateRange));
        } else {
            $startDate = null;
            $endDate = null;
        }

        $user = User::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })->count();
        $buku = Buku::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $query->whereBetween('thn_masuk', [$startDate, $endDate]);
        })->count();
        $pengunjung = Pengunjung::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })->count();


        $bukuModel = new Buku();
        $totalBuku = $bukuModel->totalBukuPerBulan($startDate, $endDate);

        $pengunjungModel = new Pengunjung();
        $totalPengunjungPerBulan = $pengunjungModel->totalPengunjungPerBulan($startDate, $endDate);
        $totalDenda = Pengunjung::selectRaw('sum(denda) as total_denda')->value('total_denda');

        $data = [
            'title' => 'Dashboard - Sistem Perpustakaan',
            'active' => 'dashboard',
            'user' => $user,
            'buku' => $buku,
            'pengunjung' => $pengunjung,
            'totalBuku' => $totalBuku,
            'totalPengunjungPerBulan' => $totalPengunjungPerBulan,
            'totalDenda' => $totalDenda,
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
