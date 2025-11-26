<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>


    <style>
        /*************  ✨ Windsurf Command 🌟  *************/
        body {
            background-size: cover;
            background-attachment: fixed;
            background-image: url('{{ asset('assets/img/login.jpg') }}');
        }

        .card {
            opacity: 0.8;
        }

        /*******  20f12c60-6315-40d7-b717-89cf718f4b0f  *******/
    </style>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-4">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h4 class="text-center mb-4 fw-bold">Login</h4>

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @elseif (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ url('/login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">
                                Login
                            </button>
                        </form>
                        <p class="mb-0">Belum punya akun ? <a href="{{ url('register') }}">register</a></p>

                    </div>
                </div>

                <p class="text-center mt-3 text-muted">
                    &copy; {{ date('Y') }} Muhammad Faisal Arif
                </p>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
