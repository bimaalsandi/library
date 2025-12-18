<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {

        $pengunjungModel = new Pengunjung();
        $reportBulan = $pengunjungModel->reportPerBulan();
        $reportMinggu = $pengunjungModel->reportPerWeek();
        $reportTahun = $pengunjungModel->reportPerTahun();

        $data = [
            'title' => 'Report - Sistem Perpustakaan',
            'active' => 'report',
            'reportMinggu' => $reportMinggu,
            'reportBulan' => $reportBulan,
            'reportTahun' => $reportTahun,
        ];
        return view('pengunjung.report', $data);
    }
}
