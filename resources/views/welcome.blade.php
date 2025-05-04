<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem Prestasi Mahasiswa</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

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

            .hero h1 {
                font-size: 3rem;
                font-weight: bold;
                margin-bottom: 1rem;
            }
            .hero p {
                font-size: 1.25rem;
                margin-bottom: 2rem;
            }
            .btn {
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                font-weight: bold;
                border-radius: 0.5rem;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }
            .btn-primary {
                background-color: #ef4444;
                color: white;
            }
            .btn-primary:hover {
                background-color: #dc2626;
            }
            .btn-secondary {
                background-color: #374151;
                color: white;
            }
            .btn-secondary:hover {
                background-color: #1f2937;
            }
            .info-section {
                padding: 2rem;
                background-color: #1f2937;
                color: white;
                text-align: center;
            }
            .info-section h2 {
                font-size: 2rem;
                margin-bottom: 1rem;
            }
            .info-section p {
                font-size: 1rem;
                line-height: 1.5;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="hero">
            <h1>Selamat Datang di <B>SIMPRES</B> (Sistem Prestasi Mahasiswa)</h1>
            <p>Sistem ini dirancang untuk mendokumentasikan dan mengelola prestasi mahasiswa secara efektif dan efisien.</p>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-secondary ml-4">Register</a>
                        @endif
                    @endauth
                @endif

                
            </div>
            
        </div>

        
    </body>
    <div class="info-section">
        <h2>Apa itu SIMPRES?</h2>
        <p>
            Sistem Prestasi Mahasiswa (SIMPRES) adalah platform yang membantu mahasiswa, dosen, dan institusi pendidikan untuk mencatat, memantau, dan mengelola berbagai prestasi akademik maupun non-akademik mahasiswa. 
            Dengan sistem ini, mahasiswa dapat lebih mudah menunjukkan pencapaian mereka, sementara institusi dapat menggunakan data ini untuk evaluasi dan pengembangan.
        </p>
    </div>
</html>
