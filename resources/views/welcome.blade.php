<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLINEMA - Portal Prestasi Mahasiswa</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    @vite('resources/css/welcome.css')
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <div class="logo-container">
                        <div class="logo-text">
                            <span class="logo-title">POLINEMA</span>
                            <span class="logo-subtitle">Portal Prestasi Mahasiswa</span>
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/') }}">Beranda</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#kontak">Kontak</a>
                        </li>
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-login" href="{{ route('login') }}">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6 hero-text">
                    <h1 class="fw-bold">Portal Prestasi Mahasiswa POLINEMA</h1>
                    <p class="lead">Temukan dan rayakan pencapaian luar biasa mahasiswa Politeknik Negeri Malang dalam
                        satu platform terintegrasi.</p>
                    <div class="hero-btns">
                        <a href="login.html" class="btn btn-primary btn-lg btn-mulai">Mulai <i
                                class="bi bi-arrow-right"></i></a>
                        <a href="#prestasi" class="btn btn-outline-secondary btn-lg ms-2">Lihat Prestasi</a>
                    </div>
                </div>
                <div class="col-lg-6 hero-image">
                    <img src="" alt="Nanti Ada Gambar Disini ya Guys"
                        class="img-fluid animated">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Achievements -->
    <section id="prestasi" class="featured-achievements">
        <div class="container">
            <div class="section-header text-center">
                <h2>Prestasi Terbaru</h2>
                <p>Pencapaian terbaik dan terbaru dari mahasiswa POLINEMA</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="achievement-card">
                        <div class="achievement-image">
                            <img src="https://images.pexels.com/photos/7096/people-woman-coffee-meeting.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                alt="Tim Robotika" class="img-fluid">
                            <div class="achievement-category">Kompetisi Nasional</div>
                        </div>
                        <div class="achievement-content">
                            <h3>Judul</h3>
                            <p>Deskripsi Deskripsi
                            </p>
                            <div class="achievement-meta">
                                <span><i class="bi bi-calendar3"></i> 15 Mei 2025</span>
                                <span><i class="bi bi-person"></i> Team</span>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary mt-3">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="achievement-card">
                        <div class="achievement-image">
                            <img src="https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                alt="Kompetisi Programming" class="img-fluid">
                            <div class="achievement-category">Kompetisi Internasional</div>
                        </div>
                        <div class="achievement-content">
                            <h3>Judul</h3>
                            <p>Deskripsi Deskripsi
                            </p>
                            <div class="achievement-meta">
                                <span><i class="bi bi-calendar3"></i> 15 Mei 2025</span>
                                <span><i class="bi bi-person"></i> Team</span>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary mt-3">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="achievement-card">
                        <div class="achievement-image">
                            <img src="https://images.pexels.com/photos/3184419/pexels-photo-3184419.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                alt="Kompetisi Bisnis" class="img-fluid">
                            <div class="achievement-category">Wirausaha</div>
                        </div>
                        <div class="achievement-content">
                            <h3>Judul</h3>
                            <p>Deskripsi Deskripsi
                            </p>
                            <div class="achievement-meta">
                                <span><i class="bi bi-calendar3"></i> 15 Mei 2025</span>
                                <span><i class="bi bi-person"></i> Team</span>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary mt-3">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#" class="btn btn-primary btn-lg">Lihat Semua Prestasi</a>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section id="statistik" class="statistics">
        <div class="container">
            <div class="section-header text-center">
                <h2>Statistik Prestasi</h2>
                <p>Angka yang menggambarkan pencapaian mahasiswa POLINEMA</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h3 class="counter">250+</h3>
                        <p>Prestasi Nasional</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-globe"></i>
                        </div>
                        <h3 class="counter">75+</h3>
                        <p>Prestasi Internasional</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h3 class="counter">1200+</h3>
                        <p>Mahasiswa Berprestasi</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h3 class="counter">45+</h3>
                        <p>Kerjasama Industri</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News and Events -->
    <section id="berita" class="news-events">
        <div class="container">
            <div class="section-header text-center">
                <h2>Berita & Acara</h2>
                <p>Informasi terbaru seputar prestasi dan kegiatan mahasiswa</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="news-main">
                        <img src="https://images.pexels.com/photos/1181622/pexels-photo-1181622.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="Kompetisi Coding" class="img-fluid">
                        <div class="news-content">
                            <div class="news-date">
                                <span class="day">25</span>
                                <span class="month">Jun</span>
                            </div>
                            <h3>Polinema Siap Gelar Kompetisi Coding Tingkat Nasional</h3>
                            <p>Politeknik Negeri Malang akan mengadakan kompetisi coding tingkat nasional dengan total
                                hadiah puluhan juta rupiah. Kompetisi ini bertujuan untuk...</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="upcoming-events">
                        <h3 class="upcoming-title">Acara Mendatang</h3>
                        <div class="event-item">
                            <div class="event-date">
                                <span class="event-day">15</span>
                                <span class="event-month">Jul</span>
                            </div>
                            <div class="event-details">
                                <h4>Workshop</h4>
                                <p><i class="bi bi-clock"></i> 09:00 - 15:00</p>
                                <p><i class="bi bi-geo-alt"></i> Gedung Teknik Sipil</p>
                            </div>
                        </div>
                        <div class="event-item">
                            <div class="event-date">
                                <span class="event-day">22</span>
                                <span class="event-month">Jul</span>
                            </div>
                            <div class="event-details">
                                <h4>Seminar Kewirausahaan</h4>
                                <p><i class="bi bi-clock"></i> 13:00 - 16:00</p>
                                <p><i class="bi bi-geo-alt"></i>AUPER</p>
                            </div>
                        </div>
                        <div class="event-item">
                            <div class="event-date">
                                <span class="event-day">30</span>
                                <span class="event-month">Jul</span>
                            </div>
                            <div class="event-details">
                                <h4>Kompetisi Desain UI/UX</h4>
                                <p><i class="bi bi-clock"></i> 08:00 - 17:00</p>
                                <p><i class="bi bi-geo-alt"></i> Lab Komputer</p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-outline-primary w-100 mt-3">Lihat Semua Acara</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Students -->
    <section class="featured-students">
        <div class="container">
            <div class="section-header text-center">
                <h2>Mahasiswa Berprestasi</h2>
                <p>Mengenal lebih dekat mahasiswa POLINEMA yang telah menorehkan prestasi</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="student-card">
                        <div class="student-image">
                            <img src="https://static.wikitide.net/hololivewiki/4/4e/Vestia_Zeta_-_Portrait_01.png?20220324044753"
                                alt="Mahasiswa 1" class="img-fluid">
                        </div>
                        <div class="student-info">
                            <h3>Vestia Zeta</h3>
                            <p class="student-program">Teknik Informatika</p>
                            <p class="student-achievement">Juara 1 Hackathon Nasional 2023</p>
                            <div class="student-social">
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="student-card">
                        <div class="student-image">
                            <img src="https://static.wikitide.net/hololivewiki/4/4e/Vestia_Zeta_-_Portrait_01.png?20220324044753"
                                alt="Mahasiswa 2" class="img-fluid">
                        </div>
                        <div class="student-info">
                            <h3>Budi Santoso</h3>
                            <p class="student-program">Teknik Elektro</p>
                            <p class="student-achievement">Penemu Sistem IoT Pendeteksi Banjir</p>
                            <div class="student-social">
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="student-card">
                        <div class="student-image">
                            <img src="https://static.wikitide.net/hololivewiki/4/4e/Vestia_Zeta_-_Portrait_01.png?20220324044753"
                                alt="Mahasiswa 3" class="img-fluid">
                        </div>
                        <div class="student-info">
                            <h3>Dian Pratiwi</h3>
                            <p class="student-program">Akuntansi</p>
                            <p class="student-achievement">Delegasi Indonesia di ASEAN Youth Summit</p>
                            <div class="student-social">
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="student-card">
                        <div class="student-image">
                            <img src="https://static.wikitide.net/hololivewiki/4/4e/Vestia_Zeta_-_Portrait_01.png?20220324044753"
                                alt="Mahasiswa 4" class="img-fluid">
                        </div>
                        <div class="student-info">
                            <h3>Arif Rahman</h3>
                            <p class="student-program">Teknik Mesin</p>
                            <p class="student-achievement">Juara Kompetisi Mobil Hemat Energi</p>
                            <div class="student-social">
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2>Siap Menunjukkan Prestasimu?</h2>
                    <p>Daftarkan diri dan bagikan pencapaian luar biasamu bersama kami.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="login.html" class="btn btn-light btn-lg">Mulai Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-about">
                        <img src="images/logo.png" alt="Logo Kita Prema tapi belum" class="footer-logo">
                        <h3>POLINEMA</h3>
                        <p>Portal Prestasi Mahasiswa Politeknik Negeri Malang adalah platform yang didedikasikan untuk
                            mendokumentasikan dan memamerkan prestasi luar biasa mahasiswa POLINEMA.</p>
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h3>Tautan</h3>
                        <ul>
                            <li><a href="#home">Beranda</a></li>
                            <li><a href="#prestasi">Prestasi</a></li>
                            <li><a href="#statistik">Statistik</a></li>
                            <li><a href="#berita">Berita</a></li>
                            <li><a href="login.html">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-links">
                        <h3>Kategori Prestasi</h3>
                        <ul>
                            <li><a href="#">Akademik</a></li>
                            <li><a href="#">Non-Akademik</a></li>
                            <li><a href="#">Penelitian</a></li>
                            <li><a href="#">Kompetisi Nasional</a></li>
                            <li><a href="#">Kompetisi Internasional</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-contact">
                        <h3>Kontak Kami</h3>
                        <p><i class="bi bi-geo-alt"></i> Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141</p>
                        <p><i class="bi bi-telephone"></i> 00000000000</p>
                        <p><i class="bi bi-envelope"></i> gatau emailnya apa ya guys</p>
                        <p><i class="bi bi-clock"></i> Senin - Jumat: 07:00 - 18:00</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; 2025 Portal Prestasi Mahasiswa POLINEMA. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p>Designed with <i class="bi bi-heart-fill"></i> by Kelompok 5 TI 2F</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Navbar scroll effect
            const mainNav = document.getElementById('mainNav');
            const backToTop = document.querySelector('.back-to-top');

            // Check if elements exist before adding event listeners
            if (mainNav) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        mainNav.classList.add('navbar-scrolled');
                    } else {
                        mainNav.classList.remove('navbar-scrolled');
                    }

                    // Back to top button visibility
                    if (backToTop) {
                        if (window.scrollY > 300) {
                            backToTop.classList.add('show');
                        } else {
                            backToTop.classList.remove('show');
                        }
                    }
                });
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    if (this.getAttribute('href') !== '#') {
                        e.preventDefault();

                        const targetId = this.getAttribute('href');
                        const targetElement = document.querySelector(targetId);

                        if (targetElement) {
                            const navHeight = mainNav.offsetHeight;
                            const targetPosition = targetElement.offsetTop - navHeight;

                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });

                            // Update active nav item
                            document.querySelectorAll('.nav-link').forEach(navLink => {
                                navLink.classList.remove('active');
                            });
                            this.classList.add('active');
                        }
                    }
                });
            });

            // Active nav item based on scroll position
            window.addEventListener('scroll', function () {
                const fromTop = window.scrollY + mainNav.offsetHeight + 50;

                document.querySelectorAll('section[id]').forEach(section => {
                    if (
                        section.offsetTop <= fromTop &&
                        section.offsetTop + section.offsetHeight > fromTop
                    ) {
                        const id = section.getAttribute('id');
                        document.querySelectorAll('.nav-link').forEach(navLink => {
                            navLink.classList.remove('active');
                            if (navLink.getAttribute('href') === '#' + id) {
                                navLink.classList.add('active');
                            }
                        });
                    }
                });
            });

            // Animated counter for statistics
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            const animateCounters = () => {
                counters.forEach(counter => {
                    const target = +counter.innerText.replace('+', '');
                    const count = 0;
                    const increment = target / speed;

                    const updateCount = () => {
                        const value = Math.ceil(count);
                        counter.innerText = value + '+';

                        if (value < target) {
                            count += increment;
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = target + '+';
                        }
                    };

                    updateCount();
                });
            };

            // Intersection Observer for animation triggers
            const observerOptions = {
                threshold: 0.2
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.id === 'statistik') {
                            animateCounters();
                        }
                        entry.target.classList.add('animated');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('section').forEach(section => {
                observer.observe(section);
            });

            // Mobile menu toggle behavior
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            if (navbarToggler && navbarCollapse) {
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', () => {
                        if (navbarCollapse.classList.contains('show')) {
                            navbarToggler.click();
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>