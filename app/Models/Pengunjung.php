<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengunjung extends Model
{
    protected $table = 'pengunjung';
    protected $guarded = ['id'];

    public function getAllPengunjung()
    {
        $query = DB::table('pengunjung')
            ->select(
                'pengunjung.*',
                'buku.kode',
                'buku.judul',
            )
            ->leftJoin('buku', 'pengunjung.id_buku', '=', 'buku.id');
        return $query->get();
    }

    public function getPengunjungById($id)
    {
        $query = DB::table('pengunjung')
            ->select(
                'pengunjung.*',
                'buku.kode',
                'buku.judul',

            )
            ->leftJoin('buku', 'pengunjung.id_buku', '=', 'buku.id')
            ->where('pengunjung.id', $id);
        return $query->first();
    }

    public function totalPengunjungPerBulan($startDate, $endDate)
    {
        $query = DB::table('pengunjung')
            ->selectRaw('COUNT(*) as total, YEAR(created_at) as tahun, MONTHNAME(created_at) as bulan, MONTH(created_at) as bulan_number')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->groupBy('tahun', 'bulan', 'bulan_number')
            ->orderBy('tahun')
            ->orderBy('bulan_number', 'asc');
        return $query->get();
    }

    public function reportPerBulan($startDate, $endDate)
    {
        $query = Pengunjung::where('status', 'Done')
            ->selectRaw('concat(monthname(updated_at), "-", year(updated_at)) as tahun_bulan, sum(denda) as total_denda, year(updated_at) as tahun, month(updated_at) as bulan')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('updated_at', [$startDate, $endDate]);
            })
            ->groupBy(['tahun_bulan', 'tahun', 'bulan'])
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();

        return $query;
    }

    public function reportPerWeek($startDate, $endDate)
    {
        $query = Pengunjung::where('status', 'Done')
            ->selectRaw('
            YEAR(updated_at) as tahun,
            WEEK(updated_at, 1) as minggu,
            CONCAT("Week ", WEEK(updated_at, 1), " - ", YEAR(updated_at)) as tahun_minggu,
            SUM(denda) as total_denda_minggu
        ')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('updated_at', [$startDate, $endDate]);
            })
            ->groupBy('tahun', 'minggu', 'tahun_minggu')
            ->orderBy('tahun', 'asc')
            ->orderBy('minggu', 'asc')
            ->get();

        return $query;
    }

    public function reportPerTahun($startDate, $endDate)
    {
        $query = Pengunjung::where('status', 'Done')
            ->selectRaw('
            YEAR(updated_at) as tahun,
            SUM(denda) as total_denda_tahun
        ')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('updated_at', [$startDate, $endDate]);
            })
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        return $query;
    }
}
