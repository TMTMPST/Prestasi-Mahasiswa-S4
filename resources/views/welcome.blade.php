<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRES - Portal Prestasi Mahasiswa POLINEMA</title>

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Swiper.js - Modern Mobile-friendly Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!-- AOS - Animation library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    @vite('resources/css/welcome.css')

    <style>
        /* Additional styles for enhanced interactivity */
        :root {
            --swiper-theme-color: var(--accent);
        }

        /* Competition card hover effect */
        .achievement-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .achievement-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        /* Animated countdown timer */
        .countdown-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 15px;
        }
        
        .countdown-item {
            text-align: center;
            background: linear-gradient(135deg, var(--surface) 0%, var(--surface-alt) 100%);
            border-radius: 10px;
            padding: 12px;
            min-width: 70px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .countdown-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--accent);
        }
        
        .countdown-label {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        /* Competition filter styles */
        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px;
        }
        
        .filter-btn {
            padding: 8px 16px;
            border-radius: 20px;
            background: var(--surface-alt);
            color: var(--text);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background: var(--accent);
            color: white;
        }
        
        /* Category badge styles */
        .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            backdrop-filter: blur(5px);
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        /* Swiper customization */
        .swiper {
            width: 100%;
            padding: 30px 10px;
        }
        
        .swiper-slide {
            width: 300px;
            height: auto;
        }
        
        .swiper-button-next, .swiper-button-prev {
            color: var(--accent);
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 18px;
        }
        
        .swiper-pagination-bullet-active {
            background: var(--accent);
        }

        /* Timeline styling */
        .timeline {
            position: relative;
            margin: 40px 0;
            padding-left: 30px;
        }
        
        .timeline:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 2px;
            background: linear-gradient(to bottom, var(--accent), var(--accent-light));
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding: 20px;
            background: var(--surface);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .timeline-item:before {
            content: '';
            position: absolute;
            left: -36px;
            top: 20px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--accent);
            border: 2px solid white;
        }

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
                        <a class="nav-link" href="#competitions">Kompetisi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#statistics">Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#timeline">Timeline</a>
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
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="hero-content">
                        <h1 class="hero-title">Portal Prestasi Mahasiswa POLINEMA</h1>
                        <p class="hero-subtitle">Platform modern untuk mendokumentasikan dan merayakan pencapaian luar
                            biasa mahasiswa Politeknik Negeri Malang.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                Mulai Sekarang
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <a href="#competitions" class="btn btn-outline">Lihat Kompetisi</a>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="hero-image">
                        <div style="width: 100%; height: 400px; border-radius: 1rem; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            <img src="https://plus.unsplash.com/premium_vector-1683134269705-3247519592a1?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDIyfHx8ZW58MHx8fHx8"
                                 alt="Mahasiswa POLINEMA"
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 1rem;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Competitions Section -->
    <section id="competitions" class="section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Kompetisi Terbaru</h2>
                <p class="section-subtitle">Kesempatan untuk mahasiswa POLINEMA menunjukkan bakat dan kemampuan</p>
            </div>

            <!-- Filter Buttons -->
            <div class="filter-buttons" data-aos="fade-up">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="nasional">Nasional</button>
                <button class="filter-btn" data-filter="internasional">Internasional</button>
                <button class="filter-btn" data-filter="free">Gratis</button>
            </div>

            <!-- Competition Slider -->
            <div class="swiper competitions-slider" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper">
                    @forelse($upcomingCompetitions as $competition)
                    <div class="swiper-slide">
                        <div class="achievement-card competition-item" 
                             data-category="{{ $competition->tingkat == 3 ? 'nasional' : ($competition->tingkat == 4 ? 'internasional' : 'regional') }}"
                             data-free="{{ $competition->biaya == 0 ? 'free' : 'paid' }}">
                            <div class="achievement-image">
                                <img src="https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?w=500" alt="{{ $competition->nama_lomba }}">
                                <div class="achievement-badge">
                                    @if($competition->tingkat == 4)
                                        Internasional
                                    @elseif($competition->tingkat == 3)
                                        Nasional
                                    @elseif($competition->tingkat == 2)
                                        Regional
                                    @else
                                        Lokal
                                    @endif
                                </div>
                                @if($competition->biaya == 0)
                                <div class="category-badge">Gratis</div>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title">{{ $competition->nama_lomba }}</h5>
                                <div class="d-flex align-items-center mb-2" style="gap:8px;">
                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ \Carbon\Carbon::parse($competition->tgl_dibuka)->format('d M Y') }}
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        {{ $competition->alamat }}
                                    </span>
                                </div>
                                <p class="text-muted mb-2">{{ $competition->penyelenggara }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">
                                        Hadiah: {{ $competition->hadiah }}
                                    </small>
                                    <a href="{{ $competition->link_lomba }}" target="_blank" class="btn btn-ghost btn-sm">Info Lebih Lanjut</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center w-100 py-5">
                        <p>Belum ada kompetisi yang tersedia saat ini.</p>
                    </div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>


        </div>
    </section>

    <!-- Statistics Section -->
    <section id="statistics" class="section" style="background: var(--surface-alt);">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Statistik Prestasi</h2>
                <p class="section-subtitle">Data pencapaian mahasiswa POLINEMA dalam angka</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div class="stat-number counter">{{ $stats['totalCompetitions'] }}</div>
                    <div class="text-muted">Total Kompetisi</div>
                </div>

                <div class="stat-card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-icon">
                        <i class="bi bi-globe"></i>
                    </div>
                    <div class="stat-number counter">{{ $stats['nationalCompetitions'] }}</div>
                    <div class="text-muted">Kompetisi Nasional</div>
                </div>

                <div class="stat-card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <div class="stat-number counter">{{ $stats['pendingRequests'] }}</div>
                    <div class="text-muted">Permintaan Bimbingan</div>
                </div>

                <div class="stat-card" data-aos="zoom-in" data-aos-delay="400">
                    <div class="stat-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="stat-number counter">{{ $stats['acceptedRequests'] }}</div>
                    <div class="text-muted">Bimbingan Diterima</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section id="timeline" class="section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Timeline Aktivitas</h2>
                <p class="section-subtitle">Perjalanan prestasi dan kompetisi mahasiswa POLINEMA</p>
            </div>

            <div class="timeline">
                @forelse($recentBimbingan as $bimbingan)
                <div class="timeline-item" data-aos="fade-right">
                    <h5>{{ $bimbingan->nama_pengaju }} mengajukan bimbingan</h5>
                    <p class="text-muted">{{ $bimbingan->deskripsi_lomba }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="badge {{ $bimbingan->status == 'Accepted' ? 'bg-success' : ($bimbingan->status == 'Rejected' ? 'bg-danger' : 'bg-warning') }}">
                            {{ $bimbingan->status }}
                        </span>
                        <small class="text-muted">{{ $bimbingan->created_at->format('d M Y') }}</small>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <p>Belum ada aktivitas bimbingan saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 data-aos="fade-up">Siap Menunjukkan Prestasimu?</h2>
            <p data-aos="fade-up" data-aos-delay="100">Bergabunglah dengan ribuan mahasiswa POLINEMA yang telah membanggakan almamater</p>
            <a href="{{ route('login') }}" class="btn" data-aos="fade-up" data-aos-delay="200"
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
                            <li><a href="#competitions">Kompetisi</a></li>
                            <li><a href="#statistics">Statistik</a></li>
                            <li><a href="#timeline">Timeline</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    
    <script>
        // Initialize AOS (Animate on Scroll)
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
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

        // Countdown timer for next competition
        function updateCountdown() {
            const countdownContainer = document.querySelector('.countdown-container');
            if (countdownContainer) {
                const deadline = new Date(countdownContainer.dataset.deadline).getTime();
                const now = new Date().getTime();
                const timeLeft = deadline - now;
                
                if (timeLeft > 0) {
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                    
                    document.getElementById('countdown-days').textContent = days.toString().padStart(2, '0');
                    document.getElementById('countdown-hours').textContent = hours.toString().padStart(2, '0');
                    document.getElementById('countdown-minutes').textContent = minutes.toString().padStart(2, '0');
                    document.getElementById('countdown-seconds').textContent = seconds.toString().padStart(2, '0');
                }
            }
        }
        
        // Initialize Swiper slider
        const swiper = new Swiper('.competitions-slider', {
            slidesPerView: 'auto',
            spaceBetween: 30,
            centeredSlides: false,
            loop: false,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            }
        });
        
        // Competition filtering
        const filterButtons = document.querySelectorAll('.filter-btn');
        const competitionItems = document.querySelectorAll('.competition-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                button.classList.add('active');
                
                const filter = button.dataset.filter;
                
                competitionItems.forEach(item => {
                    if (filter === 'all') {
                        item.style.display = 'block';
                    } else if (filter === 'free') {
                        if (item.dataset.free === 'free') {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    } else {
                        if (item.dataset.category === filter) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    }
                });
                
                // Update Swiper after filtering
                swiper.update();
            });
        });
        
        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.id === 'statistics') {
                        animateCounters();
                    }
                }
            });
        });

        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
        
        // Update countdown every second
        setInterval(updateCountdown, 1000);
        updateCountdown(); // Initialize countdown immediately
    </script>
</body>

</html>