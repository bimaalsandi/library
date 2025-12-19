<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;

class ReportController extends Controller
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

        $pengunjungModel = new Pengunjung();
        $reportBulan = $pengunjungModel->reportPerBulan($startDate, $endDate);
        $reportMinggu = $pengunjungModel->reportPerWeek($startDate, $endDate);
        $reportTahun = $pengunjungModel->reportPerTahun($startDate, $endDate);

        $data = [
            'title' => 'Report - Sistem Perpustakaan',
            'active' => 'report',
            'reportMinggu' => $reportMinggu,
            'reportBulan' => $reportBulan,
            'reportTahun' => $reportTahun,
            'date_range' => $dateRange
        ];
        return view('pengunjung.report_mingguan', $data);
    }
    public function indexBulanan(Request $request)
    {
        $dateRange = $request->input('daterange', '');
        if (!empty($dateRange)) {
            list($startDate, $endDate) = array_map('trim', explode(' - ', $dateRange));
        } else {
            $startDate = null;
            $endDate = null;
        }

        $pengunjungModel = new Pengunjung();
        $reportBulan = $pengunjungModel->reportPerBulan($startDate, $endDate);
        $reportMinggu = $pengunjungModel->reportPerWeek($startDate, $endDate);
        $reportTahun = $pengunjungModel->reportPerTahun($startDate, $endDate);

        $data = [
            'title' => 'Report - Sistem Perpustakaan',
            'active' => 'report',
            'reportMinggu' => $reportMinggu,
            'reportBulan' => $reportBulan,
            'reportTahun' => $reportTahun,
            'date_range' => $dateRange
        ];
        return view('pengunjung.report_bulanan', $data);
    }
    public function indexTahunan(Request $request)
    {
        $dateRange = $request->input('daterange', '');
        if (!empty($dateRange)) {
            list($startDate, $endDate) = array_map('trim', explode(' - ', $dateRange));
        } else {
            $startDate = null;
            $endDate = null;
        }

        $pengunjungModel = new Pengunjung();
        $reportBulan = $pengunjungModel->reportPerBulan($startDate, $endDate);
        $reportMinggu = $pengunjungModel->reportPerWeek($startDate, $endDate);
        $reportTahun = $pengunjungModel->reportPerTahun($startDate, $endDate);

        $data = [
            'title' => 'Report - Sistem Perpustakaan',
            'active' => 'report',
            'reportMinggu' => $reportMinggu,
            'reportBulan' => $reportBulan,
            'reportTahun' => $reportTahun,
            'date_range' => $dateRange
        ];
        return view('pengunjung.report_tahunan', $data);
    }
}
