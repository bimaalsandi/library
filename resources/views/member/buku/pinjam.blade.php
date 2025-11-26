@extends('layouts.member')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h4 class="text-start mb-0 fw-bold">Form Pinjam Buku</h4>
                        <p class="text-muted mb-3">
                            <i> {{ $buku->judul }} ({{ $buku->kode }})</i>
                        </p>

                        <form action="{{ url('/buku/process-pinjam') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                                <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                                <input type="text" name="nis" class="form-control" required
                                    value="{{ old('nis') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required
                                    value="{{ old('nama', Auth::user()->name) }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <input type="text" name="kelas" class="form-control" required
                                    value="{{ old('kelas') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pinjam</label>
                                <input type="date" name="tgl_pinjam" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kembali</label>
                                <input type="date" name="tgl_kembali" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
