@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow-sm">
                    <div class="card-header fw-bold">
                        Edit Data Buku
                    </div>
                    <div class="card-body">


                        <form action="{{ url('pengunjung/update/' . $pengunjung->id) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">NIS</label>
                                        <input type="text" name="nis" class="form-control"
                                            value="{{ $pengunjung->nis }}" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ $pengunjung->nama }}" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <input type="text" name="kelas" class="form-control"
                                            value="{{ $pengunjung->kelas }}" required readonly>
                                    </div>

                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Kode Buku</label>
                                        <input type="text" name="kode" class="form-control"
                                            value="{{ $pengunjung->kode }}" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Judul Buku</label>
                                        <input type="text" name="judul" class="form-control"
                                            value="{{ $pengunjung->judul }}" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Pinjam</label>
                                                <input type="date" name="tgl_pinjam" class="form-control"
                                                    value="{{ $pengunjung->tgl_pinjam }}" required readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Kembali</label>
                                                <input type="date" name="tgl_kembali" class="form-control"
                                                    value="{{ $pengunjung->tgl_kembali }}" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" id="" class="form-select">
                                            <option value="">Pilih Status</option>
                                            <option value="Pinjam" {{ $pengunjung->status == 'Pinjam' ? 'selected' : '' }}>
                                                Pinjam
                                            </option>
                                            <option value="Done" {{ $pengunjung->status == 'Done' ? 'selected' : '' }}>
                                                Done
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Denda</label>
                                        <input type="text" name="denda" value="{{ $pengunjung->denda }}"
                                            class="form-control" id="">

                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
