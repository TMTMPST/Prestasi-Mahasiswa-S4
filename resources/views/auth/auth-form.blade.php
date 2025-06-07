<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet"
    integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
  <!-- CoreUI icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/icons@3.0.1/css/all.min.css">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <!-- Custom CSS -->
  @vite('resources/css/welcome.css')

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <title>{{ isset($isRegister) ? 'Daftar' : 'Masuk' }} - SIMPRES</title>
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <style>
    :root {
      --primary: #1a1a1a;
      --secondary: #f8fafc;
      --accent: #f26430;
      --accent-hover: #e55b2b;
      --accent-light: #f9a11b;
      --text-primary: #111827;
      --text-secondary: #6b7280;
      --text-muted: #9ca3af;
      --border: #e5e7eb;
      --surface: #ffffff;
      --surface-alt: #f9fafb;
      --shadow: rgba(0, 0, 0, 0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, var(--surface-alt) 0%, #fef3e9 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
    }

    .auth-container {
      width: 100%;
      max-width: 1000px;
      background: var(--surface);
      border-radius: 1.5rem;
      box-shadow: 0 25px 50px -12px var(--shadow);
      overflow: hidden;
      display: grid;
      grid-template-columns: 1fr 1fr;
      min-height: 600px;
    }

    .auth-form-section {
      padding: 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .auth-visual-section {
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 3rem;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .auth-visual-section::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

      0%,
      100% {
        transform: translate(0, 0) rotate(0deg);
      }

      50% {
        transform: translate(-20px, -20px) rotate(180deg);
      }
    }

    .logo {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1rem;
      z-index: 1;
    }

    .auth-title {
      font-size: 2rem;
      font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 0.5rem;
    }

    .auth-subtitle {
      color: var(--text-secondary);
      margin-bottom: 2rem;
      font-size: 0.95rem;
    }

    .form-floating {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .form-control {
      border: 2px solid var(--border);
      border-radius: 0.75rem;
      padding: 1rem;
      font-size: 0.95rem;
      transition: all 0.2s ease;
      background: var(--surface);
    }

    .form-control:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 0.2rem rgba(242, 100, 48, 0.25);
      background: var(--surface);
    }

    .form-floating>label {
      padding-left: 1rem;
      color: var(--text-muted);
      font-weight: 500;
    }

    /* Remove icon styles */
    .input-icon {
      display: none;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
      border: none;
      border-radius: 0.75rem;
      padding: 0.875rem 2rem;
      font-weight: 600;
      font-size: 0.95rem;
      color: white;
      transition: all 0.3s ease;
      width: 100%;
      margin-bottom: 1.5rem;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(242, 100, 48, 0.4);
      background: linear-gradient(135deg, var(--accent-hover) 0%, var(--accent) 100%);
    }

    .form-check {
      margin-bottom: 1.5rem;
    }

    .form-check-input:checked {
      background-color: var(--accent);
      border-color: var(--accent);
    }

    .form-check-label {
      color: var(--text-secondary);
      font-size: 0.9rem;
    }

    .toggle-link {
      color: var(--accent);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s ease;
    }

    .toggle-link:hover {
      color: var(--accent-hover);
    }

    .divider {
      display: flex;
      align-items: center;
      margin: 1.5rem 0;
      color: var(--text-muted);
      font-size: 0.9rem;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    .divider span {
      padding: 0 1rem;
    }

    .alert {
      border: none;
      border-radius: 0.75rem;
      padding: 1rem 1.25rem;
      margin-bottom: 1.5rem;
    }

    .alert-success {
      background: rgba(16, 185, 129, 0.1);
      color: #059669;
      border-left: 4px solid #10b981;
    }

    .alert-danger {
      background: rgba(239, 68, 68, 0.1);
      color: #dc2626;
      border-left: 4px solid #ef4444;
    }

    .back-to-home {
      position: absolute;
      top: 2rem;
      left: 2rem;
      color: var(--accent);
      text-decoration: none;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.2s ease;
    }

    .back-to-home:hover {
      color: var(--accent-hover);
      transform: translateX(-4px);
    }

    @media (max-width: 768px) {
      .auth-container {
        grid-template-columns: 1fr;
        max-width: 400px;
        margin: 1rem;
      }

      .auth-visual-section {
        order: -1;
        padding: 2rem;
        min-height: 200px;
      }

      .auth-form-section {
        padding: 2rem;
      }

      .back-to-home {
        top: 1rem;
        left: 1rem;
      }
    }

    .fade-in {
      animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
  </style>
</head>

<body>
  <a href="{{ url('/') }}" class="back-to-home">
    <i class="bi bi-arrow-left"></i>
    Kembali ke Beranda
  </a>

  <div class="auth-container fade-in">
    <!-- Form Section -->
    <div class="auth-form-section">
      <div id="loginForm">
        <h1 class="auth-title">Selamat Datang</h1>
        <p class="auth-subtitle">Masuk ke akun Anda untuk mengakses portal prestasi mahasiswa</p>

        @if(session('success'))
      <div class="alert alert-success">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
      </div>
    @endif

        @if($errors->any())
      <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle me-2"></i>
        {{ $errors->first() }}
      </div>
    @endif

        <form method="POST" action="{{ route('login.submit') }}">
          @csrf
          <div class="form-floating">
            <input type="text" class="form-control @error('login_id') is-invalid @enderror" 
                   id="loginId" name="login_id" placeholder="NIM/Username" 
                   value="{{ old('login_id') }}" required autofocus>
            <label for="loginId">NIM/Username</label>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberMe">
            <label class="form-check-label" for="rememberMe">
              Ingat saya
            </label>
          </div>

          <button type="submit" class="btn btn-primary">
            <i class="bi bi-box-arrow-in-right me-2"></i>
            Masuk
          </button>
        </form>

        <div class="text-center">
          <p class="mb-2">
            <a href="#" class="toggle-link">Lupa password?</a>
          </p>
          <p class="text-muted">
            Belum punya akun?
            <a href="#" class="toggle-link" onclick="toggleForm()">Daftar sekarang</a>
          </p>
        </div>
      </div>

      <div id="registerForm" style="display: none;">
        <h1 class="auth-title">Buat Akun Baru</h1>
        <p class="auth-subtitle">Daftarkan diri Anda untuk bergabung dengan portal prestasi</p>

        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="form-floating">
            <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                   id="nim" name="nim" placeholder="NIM" 
                   value="{{ old('nim') }}" required>
            <label for="nim">NIM</label>
          </div>

          <div class="form-floating">
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" placeholder="Nama Lengkap" 
                   value="{{ old('name') }}" required>
            <label for="name">Nama Lengkap</label>
          </div>

          <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   id="email" name="email" placeholder="Email" 
                   value="{{ old('email') }}" required>
            <label for="email">Email</label>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="registerPassword" name="password" placeholder="Password" required>
            <label for="registerPassword">Password</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label" for="terms">
              Saya setuju dengan <a href="#" class="toggle-link">syarat dan ketentuan</a>
            </label>
          </div>

          <button type="submit" class="btn btn-primary">
            <i class="bi bi-person-plus me-2"></i>
            Daftar
          </button>
        </form>

        <div class="text-center">
          <p class="text-muted">
            Sudah punya akun?
            <a href="#" class="toggle-link" onclick="toggleForm()">Masuk di sini</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Visual Section -->
    <div class="auth-visual-section">
      <div class="logo">SIMPRES</div>
      <h2 id="visualTitle">Portal Prestasi Mahasiswa</h2>
      <p id="visualSubtitle">Dokumentasikan dan rayakan pencapaian luar biasa Anda di POLINEMA</p>

      <div class="mt-4">
        <i class="bi bi-trophy" style="font-size: 4rem; opacity: 0.8;"></i>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleForm() {
      const loginForm = document.getElementById('loginForm');
      const registerForm = document.getElementById('registerForm');
      const visualTitle = document.getElementById('visualTitle');
      const visualSubtitle = document.getElementById('visualSubtitle');

      if (loginForm.style.display === 'none') {
        // Show login form
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        visualTitle.textContent = 'Portal Prestasi Mahasiswa';
        visualSubtitle.textContent = 'Dokumentasikan dan rayakan pencapaian luar biasa Anda di POLINEMA';
      } else {
        // Show register form
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
        visualTitle.textContent = 'Bergabunglah Bersama Kami';
        visualSubtitle.textContent = 'Mulai perjalanan Anda menuju prestasi yang membanggakan';
      }
    }

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
      });
    }, 5000);
  </script>

</body>

</html>