<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        $data = [
            'title' => 'Buku - Sistem Perpustakaan',
            'active' => 'buku',
            'buku' => $buku
        ];
        return view('buku.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Buku - Sistem Perpustakaan',
            'active' => 'buku'
        ];
        return view('buku.create', $data);
    }

    public function save(Request $request)
    {
        $buku = new Buku();
        $buku->create($request->all());
        return redirect('/buku')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $buku = Buku::find($id);
        $data = [
            'title' => 'Tambah Buku - Sistem Perpustakaan',
            'active' => 'buku',
            'buku' => $buku
        ];
        return view('buku.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->update($request->all());
        return redirect('/buku')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('success', 'Data berhasil dihapus');
    }

    public function pinjam($id)
    {
        $buku = Buku::find($id);
        $data = [
            'title' => 'Pinjam Buku - Sistem Perpustakaan',
            'active' => 'buku',
            'buku' => $buku
        ];
        return view('member.buku.pinjam', $data);
    }

    public function processPinjam(Request $request)
    {
        $pengunjung = new Pengunjung();
        $pengunjung->id_buku = $request->input('id_buku');
        $pengunjung->id_user = Auth::id();
        $pengunjung->nis = $request->input('nis');
        $pengunjung->nama = $request->input('nama');
        $pengunjung->kelas = $request->input('kelas');
        $pengunjung->tgl_pinjam = $request->input('tgl_pinjam');
        $pengunjung->tgl_kembali = $request->input('tgl_kembali');
        $pengunjung->status = 'Pinjam';
        $pengunjung->save();

        $buku = Buku::find($request->input('id_buku'));
        $buku->stock = $buku->stock - 1;
        $buku->save();
        return redirect('/dashboard-member')->with('success', 'Buku berhasil dipinjam');
    }

    public function listPinjamanBuku()
    {
        $bukuModel = new Buku();
        $listBuku = $bukuModel->listBukuYangDipinjam(Auth::id());
        if ($listBuku) {
            foreach ($listBuku as $rl) {
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
            'title' => 'List Pinjaman Buku - Sistem Perpustakaan',
            'active' => 'pinjaman',
            'listBuku' => $listBuku
        ];
        return view('member.buku.list', $data);
    }
}
