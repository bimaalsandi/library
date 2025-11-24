@extends('layouts.member')
@section('content')
    <div class="container mt-4">
        <h5 class="text-muted">List Buku yang Dipinjam</h5>
        <div class="card p-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table" id="listTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Penerbit</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Dikembalikan</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($listBuku as $rl)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $rl->kode }}</td>
                                <td>{{ $rl->judul }}</td>
                                <td>{{ $rl->penerbit }}</td>
                                <td>{{ $rl->tgl_pinjam }}</td>
                                <td>{{ $rl->tgl_kembali }}</td>
                                <td>
                                    @if ($rl->status == 'Pinjam')
                                        <span class="badge bg-info">{{ $rl->status }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $rl->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $rl->denda }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#listTable').DataTable();
        });
    </script>
@endsection
