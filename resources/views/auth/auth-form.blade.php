<!doctype html>
<html lang="en">

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

  <title>Login</title>
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <style>
    body {
      background-color: #f8f9fa;
      overflow-x: hidden;
    }

    .auth-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      position: relative;
    }

    .auth-box {
      max-width: 800px;
      width: 100%;
      height: 500px;
      position: relative;
      perspective: 1000px;
    }

    .auth-card {
      position: absolute;
      width: 100%;
      height: 100%;
      transform-style: preserve-3d;
      transition: transform 0.6s;
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      display: flex;
    }

    .auth-card.flipped {
      transform: rotateY(180deg);
    }

    .auth-side {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      display: flex;
    }

    .auth-content {
      flex: 1;
      padding: 3rem;
    }

    .auth-image {
      flex: 1;
      background: linear-gradient(135deg, var(--primary) 0%, var(--accent1) 100%);
      padding: 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: white;
      border-top-right-radius: 15px;
      border-bottom-right-radius: 15px;
    }

    .register-side {
      transform: rotateY(180deg);
    }

    .register-side .auth-image {
      border-radius: 15px 0 0 15px;
      order: -1;
    }

    .auth-title {
      font-size: 2rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 2rem;
    }

    .form-floating {
      margin-bottom: 1.5rem;
    }

    .form-control:focus {
      border-color: var(--accent1);
      box-shadow: 0 0 0 0.25rem rgba(242, 100, 48, 0.25);
    }

    .btn-auth {
      background-color: var(--accent2);
      border-color: var(--accent2);
      color: white;
      padding: 0.8rem 2rem;
      font-weight: 600;
      width: 100%;
      margin-top: 1rem;
    }

    .btn-auth:hover {
      background-color: #e6a700;
      border-color: #e6a700;
    }

    .auth-footer {
      text-align: center;
      margin-top: 2rem;
    }

    .auth-footer a {
      color: var(--accent1);
      text-decoration: none;
      cursor: pointer;
    }

    .auth-footer a:hover {
      text-decoration: underline;
    }

    .back-link {
      position: absolute;
      top: 2rem;
      left: 2rem;
      color: var(--dark);
      text-decoration: none;
      z-index: 1000;
      padding: 0.5rem;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .back-link:hover {
      color: var(--accent1);
      background-color: rgba(255, 255, 255, 0.1);
    }

    .alert-custom {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
      min-width: 300px;
      animation: slideIn 0.3s ease-in-out;
    }

    @keyframes slideIn {
      from {
        transform: translateX(100%);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .form-control.error {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }

    @media (max-width: 768px) {
      .auth-image {
        display: none;
      }

      .auth-content {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <a href="{{ url('/') }}" class="back-link">
    <i class="bi bi-arrow-left"></i> Kembali ke Beranda
  </a>

  <div class="auth-container">
    <div class="auth-box">
      <div class="auth-card">
        <!-- Login Side -->
        @include('auth.partials.login-form')

        <!-- Register Side -->

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js"
    integrity="sha384-8QmUFX1sl4cMveCP2+H1tyZlShMi1LeZCJJxTZeXDxOwQexlDrLQ3O9L78gwBbe" crossorigin="anonymous"></script>
  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Custom alert function for better styling
      window.showAlert = function (message, type = 'danger') {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show alert-custom`;
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(alert);

        // Auto remove after 5 seconds
        setTimeout(() => {
          if (alert.parentNode) {
            alert.remove();
          }
        }, 5000);
      };
    });
  </script>

</body>

</html>