<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buku extends Model
{
    protected $table = 'buku';
    protected $guarded = ['id'];


    public function getAllBuku($search)
    {
        $query = DB::table('buku')
            ->select('*')
            ->where('judul', 'like', '%' . $search . '%');
        return $query->paginate(6);
    }

    public function listBukuYangDipinjam($id_user)
    {
        $query = DB::table('buku')
            ->select(
                'buku.*',
                'pengunjung.tgl_pinjam',
                'pengunjung.tgl_kembali',
                'pengunjung.denda',
                'pengunjung.status',
            )
            ->leftJoin('pengunjung', 'pengunjung.id_buku', '=', 'buku.id')
            ->where('pengunjung.id_user', $id_user);
        return $query->get();
    }

    public function totalBukuPerBulan($startDate, $endDate)
    {
        $query = DB::table('buku')
            ->selectRaw('COUNT(*) as total, YEAR(thn_masuk) as tahun, MONTHNAME(thn_masuk) as bulan, MONTH(thn_masuk) as bulan_number')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('thn_masuk', [$startDate, $endDate]);
            })
            ->groupBy('tahun', 'bulan', 'bulan_number')
            ->orderBy('tahun')
            ->orderBy('bulan_number', 'asc');
        return $query->get();
    }
}
