@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <h4>List Buku</h4>
        <div class="card p-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a href="{{ url('buku/create') }}" class="btn btn-primary mb-1 me-auto">Tambah Buku</a>
            <div class="table-responsive">
                <table class="table" id="bukuTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Tahun Masuk</th>
                            <th>Ketersediaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($buku as $rb)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $rb->kode }}</td>
                                <td>{{ $rb->judul }}</td>
                                <td>{{ $rb->penerbit }}</td>
                                <td>{{ $rb->thn_terbit }}</td>
                                <td>{{ $rb->thn_masuk }}</td>
                                <td>{{ $rb->stock }}</td>
                                <td>
                                    <a href="{{ url('buku/edit/' . $rb->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ url('buku/delete/' . $rb->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah kamu yakin untuk hapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#bukuTable').DataTable();
        });
    </script>
@endsection
