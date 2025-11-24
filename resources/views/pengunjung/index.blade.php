@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <h4>List Pengunjung</h4>
        <div class="card p-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table" id="pengunjungTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Judul</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($pengunjung as $rp)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $rp->nis }}</td>
                                <td>{{ $rp->nama }}</td>
                                <td>{{ $rp->kelas }}</td>
                                <td>{{ $rp->judul }}</td>
                                <td>{{ $rp->tgl_pinjam }}</td>
                                <td>{{ $rp->tgl_kembali }}</td>
                                <td>
                                    @if ($rp->status == 'Pinjam')
                                        <span class="badge bg-info">{{ $rp->status }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $rp->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $rp->denda }}</td>
                                <td>
                                    <a href="{{ url('pengunjung/edit/' . $rp->id) }}" class="btn btn-warning">Edit</a>
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
            $('#pengunjungTable').DataTable();
        });
    </script>
@endsection
