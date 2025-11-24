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
}
