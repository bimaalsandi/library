@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <h4>List User</h4>
        <div class="card p-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a href="{{ route('user.create') }}" class="btn btn-primary mb-1 me-auto">Tambah User</a>
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($user as $ru)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $ru->name }}</td>
                            <td>{{ $ru->email }}</td>
                            <td>{{ $ru->role }}</td>
                            <td>
                                <a href="{{ route('user.edit', $ru->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('user.destroy', $ru->id) }}" method="post" class="d-inline"
                                    onsubmit="return confirm('Apakah kamu yakin untuk hapus data ini?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });
    </script>
@endsection
