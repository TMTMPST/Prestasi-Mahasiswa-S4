<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRES - Portal Prestasi Mahasiswa POLINEMA</title>

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    @vite('resources/css/welcome.css')

    <style>
        /* Additional orange theme adjustments */
        .btn-outline {
            background: transparent;
            color: var(--accent);
            border: 2px solid var(--accent);
        }

        .btn-outline:hover {
            background: var(--accent);
            color: white;
            transform: translateY(-2px);
        }

        .hero-image div {
            background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%) !important;
            color: var(--accent) !important;
        }

        /* Custom scrollbar with orange theme */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--surface-alt);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-hover);
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">SIMPRES</a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#prestasi">Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#statistik">Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#berita">Berita</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary" href="{{ route('login') }}">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">Portal Prestasi Mahasiswa POLINEMA</h1>
                        <p class="hero-subtitle">Platform modern untuk mendokumentasikan dan merayakan pencapaian luar
                            biasa mahasiswa Politeknik Negeri Malang.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                Mulai Sekarang
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <a href="#prestasi" class="btn btn-outline">Lihat Prestasi</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%); border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #f26430;">
                            <i class="bi bi-trophy" style="font-size: 4rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Prestasi Section -->
    <section id="prestasi" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Prestasi Terbaru</h2>
                <p class="section-subtitle">Pencapaian gemilang mahasiswa POLINEMA yang membanggakan</p>
            </div>

            <div class="achievement-grid">
                <div class="achievement-card">
                    <div class="achievement-image">
                        <img src="https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?w=500" alt="Achievement 1">
                        <div class="achievement-badge">Nasional</div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title">Juara 1 Hackathon Indonesia</h5>
                        <p class="text-muted">Tim mahasiswa TI berhasil meraih juara pertama dalam kompetisi teknologi
                            tingkat nasional.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                22 Juni 2025
                            </small>
                            <a href="#" class="btn btn-ghost btn-sm">Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <div class="achievement-card">
                    <div class="achievement-image">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500" alt="Achievement 2">
                        <div class="achievement-badge">Internasional</div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title">Best Innovation Award</h5>
                        <p class="text-muted">Proyek IoT mahasiswa Teknik Elektro meraih penghargaan inovasi terbaik di
                            ajang internasional.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                22 Juni 2025
                            </small>
                            <a href="#" class="btn btn-ghost btn-sm">Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <div class="achievement-card">
                    <div class="achievement-image">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=500" alt="Achievement 3">
                        <div class="achievement-badge">Startup</div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title">Startup Terbaik 2024</h5>
                        <p class="text-muted">Mahasiswa Akuntansi berhasil membangun startup yang diakui sebagai yang
                            terbaik tahun ini.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-1"></i>
                                22 Juni 2025
                            </small>
                            <a href="#" class="btn btn-ghost btn-sm">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section id="statistik" class="section" style="background: var(--surface-alt);">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Statistik Prestasi</h2>
                <p class="section-subtitle">Data pencapaian mahasiswa POLINEMA dalam angka</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div class="stat-number counter">250</div>
                    <div class="text-muted">Prestasi Nasional</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-globe"></i>
                    </div>
                    <div class="stat-number counter">75</div>
                    <div class="text-muted">Prestasi Internasional</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <div class="stat-number counter">1200</div>
                    <div class="text-muted">Mahasiswa Berprestasi</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="stat-number counter">45</div>
                    <div class="text-muted">Kerjasama Industri</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Section -->
    <section id="berita" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Berita & Acara</h2>
                <p class="section-subtitle">Informasi terkini seputar aktivitas dan pencapaian mahasiswa</p>
            </div>

            <div class="news-grid">
                <div class="news-main">
                    <div class="news-image">
                        <img src="https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?w=800" alt="News">
                    </div>
                    <div class="news-content">
                        <div class="news-date">22 Juni 2025</div>
                        <h3>POLINEMA Gelar Kompetisi Teknologi Nasional 2024</h3>
                        <p class="text-muted">Politeknik Negeri Malang kembali mengadakan kompetisi teknologi tingkat
                            nasional dengan hadiah total ratusan juta rupiah...</p>
                        <a href="#" class="btn btn-primary mt-3">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="events-sidebar">
                    <h4 class="mb-4">Acara Mendatang</h4>

                    <div class="event-item">
                        <div class="event-date">
                            <div class="event-day">15</div>
                            <div class="event-month">Jul</div>
                        </div>
                        <div>
                            <h6 class="mb-1">Workshop AI & Machine Learning</h6>
                            <small class="text-muted">Gedung Teknik Informatika</small>
                        </div>
                    </div>

                    <div class="event-item">
                        <div class="event-date">
                            <div class="event-day">22</div>
                            <div class="event-month">Jul</div>
                        </div>
                        <div>
                            <h6 class="mb-1">Seminar Kewirausahaan Digital</h6>
                            <small class="text-muted">Auditorium POLINEMA</small>
                        </div>
                    </div>

                    <div class="event-item">
                        <div class="event-date">
                            <div class="event-day">30</div>
                            <div class="event-month">Jul</div>
                        </div>
                        <div>
                            <h6 class="mb-1">Hackathon Mobile App</h6>
                            <small class="text-muted">Lab Komputer Terpadu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <h2>Siap Menunjukkan Prestasimu?</h2>
            <p>Bergabunglah dengan ribuan mahasiswa POLINEMA yang telah membanggakan almamater</p>
            <a href="{{ route('login') }}" class="btn"
                style="background: rgba(255,255,255,0.2); color: white; border: 2px solid white; backdrop-filter: blur(10px);">
                Mulai Sekarang
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-section">
                        <h3>SIMPRES</h3>
                        <p class="text-muted">Portal Prestasi Mahasiswa Politeknik Negeri Malang yang didedikasikan untuk
                            mendokumentasikan pencapaian luar biasa mahasiswa.</p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-section">
                        <h3>Menu</h3>
                        <ul class="footer-links">
                            <li><a href="#home">Beranda</a></li>
                            <li><a href="#prestasi">Prestasi</a></li>
                            <li><a href="#statistik">Statistik</a></li>
                            <li><a href="#berita">Berita</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-section">
                        <h3>Kategori</h3>
                        <ul class="footer-links">
                            <li><a href="#">Akademik</a></li>
                            <li><a href="#">Kompetisi</a></li>
                            <li><a href="#">Penelitian</a></li>
                            <li><a href="#">Kewirausahaan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="footer-section">
                        <h3>Kontak</h3>
                        <p class="text-muted">
                            <i class="bi bi-geo-alt me-2"></i>
                            Jl. Soekarno Hatta No.9, Malang
                        </p>
                        <p class="text-muted">
                            <i class="bi bi-envelope me-2"></i>
                            info@polinema.ac.id
                        </p>
                        <p class="text-muted">
                            <i class="bi bi-telephone me-2"></i>
                            (0341) 404424
                        </p>
                    </div>
                </div>
            </div>
            <hr style="border-color: #374151;">
            <div class="text-center py-3">
                <p class="text-muted mb-0">&copy; 2024 SIMPRES POLINEMA. Dibuat dengan ❤️ oleh Kelompok 5 TI 2F
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Modern navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Counter animation
        const counters = document.querySelectorAll('.counter');
        const animateCounters = () => {
            counters.forEach(counter => {
                const target = parseInt(counter.innerText);
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        counter.innerText = target;
                        clearInterval(timer);
                    } else {
                        counter.innerText = Math.floor(current);
                    }
                }, 16);
            });
        };

        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.id === 'statistik') {
                        animateCounters();
                    }
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        });

        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    </script>
</body>

</html>