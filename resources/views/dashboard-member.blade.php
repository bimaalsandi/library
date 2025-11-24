@extends('layouts.member')
@section('content')
    <div class="container my-4">

        <h5 class="mb-4 text-muted">List Buku yang Bisa Dipinjam</h5>



        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">

            <form action="" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari judul buku" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                    <a href="{{ url('dashboard-member') }}" class="btn btn-outline-danger">Reset</a>
                </div>
            </form>

            @forelse ($buku as $rb)
                <!-- Buku 1 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card book-card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $rb->judul }}</h5>
                            <p class="card-text text-muted mb-1">{{ $rb->penerbit }}</p>
                            <p class="card-text"><small
                                    class="text-muted">{{ date('Y', strtotime($rb->thn_terbit)) }}</small>
                            </p>
                            @if ($rb->stock > 0)
                                <span class="badge text-bg-primary my-2">Tersedia</span>
                            @else
                                <span class="badge text-bg-secondary my-2">Tidak Tersedia</span>
                            @endif
                            <div class="d-grid">
                                @if ($rb->stock > 0 && $rb->status != 'Pinjam')
                                    <a href="{{ url('buku/pinjam/' . $rb->id) }}" class="btn btn-primary">Pinjam</a>
                                @else
                                    <a href="{{ url('buku/pinjam/' . $rb->id) }}" class="btn btn-secondary disabled">Masih
                                        Dalam Pinjaman</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Data Not Found</p>
            @endforelse

            {{ $buku->links() }}






        </div>

    </div>
@endsection
