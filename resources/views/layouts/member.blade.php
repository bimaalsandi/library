<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Member - List Buku</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery wajib -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables v2 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- DataTables v2 JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>


</head>

<body>

    <!-- ========================= NAVBAR ========================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem perpustakaan</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <li class="nav-item me-3 d-flex align-items-center">
                <a href="{{ url('dashboard-member') }}"
                    class="nav-link text-white {{ $active == 'dashboard' ? 'fw-bold' : '' }}">Home</a>
            </li>
            <li class="nav-item me-3 d-flex align-items-center">
                <a href="{{ url('list-pinjaman-buku') }}"
                    class="nav-link text-white {{ $active == 'pinjaman' ? 'fw-bold' : '' }}">List Pinjaman Buku</a>
            </li>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">


                    <div class="d-flex align-items-center">

                        <div class="dropdown">
                            <button class="btn btn-transparent text-light dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li>
                                    <form action="{{ url('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>

                </ul>
            </div>
        </div>
    </nav>
    <!-- =========================================================== -->


    @yield('content')



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".btn-pinjam").on("click", function() {
                alert("Buku berhasil diajukan untuk dipinjam!");
            });
        });
    </script>

</body>

</html>
