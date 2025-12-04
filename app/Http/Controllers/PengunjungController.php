<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function index()
    {
        $pengunjungModel = new Pengunjung();
        $pengunjung = $pengunjungModel->getAllPengunjung();
        if ($pengunjung) {
            foreach ($pengunjung as $rl) {
                $today = date('Y-m-d');
                $tgl_kembali = date('Y-m-d', strtotime($rl->tgl_kembali));
                if ($today > $tgl_kembali) {
                    $selisih = abs(strtotime($today) - strtotime($tgl_kembali));
                    $hari = floor($selisih / (60 * 60 * 24));
                } else {
                    $hari = 0;
                }
                $rl->denda = $hari * 5000;
            }
        }
        $data = [
            'title' => 'Pengunjung - Sistem Perpustakaan',
            'active' => 'pengunjung',
            'pengunjung' => $pengunjung
        ];
        return view('pengunjung.index', $data);
    }

    public function edit($id)
    {

        $pengunjungModel = new Pengunjung();
        $pengunjung = $pengunjungModel->getPengunjungById($id);
        $today = date('Y-m-d');
        $tgl_kembali = date('Y-m-d', strtotime($pengunjung->tgl_kembali));
        if ($today > $tgl_kembali) {
            $selisih = abs(strtotime($today) - strtotime($tgl_kembali));
            $hari = floor($selisih / (60 * 60 * 24));
        } else {
            $hari = 0;
        }
        $pengunjung->denda = $hari * 5000;
        $data = [
            'title' => 'Edit Pengunjung - Sistem Perpustakaan',
            'active' => 'pengunjung',
            'pengunjung' => $pengunjung
        ];
        return view('pengunjung.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $pengunjung = Pengunjung::find($id);
        $pengunjung->status = $request->input('status');
        $pengunjung->denda = $request->input('denda');
        $pengunjung->save();


        if ($request->input('status') == 'Done') {
            $buku = Buku::find($pengunjung->id_buku);
            $buku->stock = $buku->stock + 1;
            $buku->save();
        }

        return redirect('/pengunjung')->with('success', 'Data berhasil diupdate');
    }
}
