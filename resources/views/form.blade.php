<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deteksi Diabetes</title>
    <!-- Favicon -->
    {{-- <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"> --}}
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .bg-gradient {
            background: linear-gradient(45deg, #ff7e5f, #feb47b);
        }
        .shadow-lg {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .rounded-4 {
            border-radius: 1.25rem;
        }
    </style>
</head>
<body>

    <!-- Navbar (Optional) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('diabetes.start') }}">Deteksi Diabetes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('diabetes.start') }}">Beranda</a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0 text-muted">© 2024 Deteksi Diabetes. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
