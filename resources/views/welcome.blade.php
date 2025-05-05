<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem Prestasi Mahasiswa</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Figtree', sans-serif;
            }
            .hero {
                background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9)),
                                url("{{ asset('storage/background/background_1.jpg') }}");
                background-repeat: no-repeat;
                background-position: center center;
                background-size: cover;
                color: white;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .btn-primary:hover {
                background-color: #000000;
            }

            .btn-secondary:hover {
                background-color: #000000;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="hero">
            <h1 class="display-4">Selamat Datang di <b>SIMPRES</b> (Sistem Prestasi Mahasiswa)</h1>
            <p class="lead">Sistem ini dirancang untuk mendokumentasikan dan mengelola prestasi mahasiswa secara efektif dan efisien.</p>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Start</a>

                    @endauth
                @endif
            </div>
        </div>

        <div class="info-section bg-dark text-white text-center py-5">
            <h2 class="mb-4">Apa itu SIMPRES?</h2>
            <p class="mb-0">
                Sistem Prestasi Mahasiswa (SIMPRES) adalah platform yang membantu mahasiswa, dosen, dan institusi pendidikan untuk mencatat, memantau, dan mengelola berbagai prestasi akademik maupun non-akademik mahasiswa. 
                Dengan sistem ini, mahasiswa dapat lebih mudah menunjukkan pencapaian mereka, sementara institusi dapat menggunakan data ini untuk evaluasi dan pengembangan.
            </p>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
