@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-header fw-bold">
                        Edit Data Buku
                    </div>
                    <div class="card-body">

                        <form action="{{ url('/buku/update/' . $buku->id) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label class="form-label">Kode Buku</label>
                                <input type="text" name="kode" class="form-control" value="{{ $buku->kode }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Judul Buku</label>
                                <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" value="{{ $buku->penerbit }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tahun Terbit</label>
                                <input type="date" name="thn_terbit" class="form-control"
                                    value="{{ $buku->thn_terbit }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tahun Masuk</label>
                                <input type="date" name="thn_masuk" class="form-control" value="{{ $buku->thn_masuk }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ketersediaan</label>
                                <input type="number" name="stock" class="form-control" value="{{ $buku->stock }}">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Simpan
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
