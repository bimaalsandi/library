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
}
