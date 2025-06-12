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

    <title>{{ config('app.name', 'SIMPRES') }}</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('resources/css/welcome.css')
    @stack('styles')
    
    <style>
        /* Minimal fix for responsive sidebar content */
        .content-wrapper {
            transition: margin-left 0.15s ease-in-out;
        }
        
        /* When sidebar is expanded (default CoreUI width is 256px) */
        .sidebar:not(.sidebar-unfoldable) ~ .content-wrapper {
            margin-left: 256px;
        }
        
        /* When sidebar is collapsed (CoreUI collapsed width is 56px) */
        .sidebar.sidebar-unfoldable ~ .content-wrapper {
            margin-left: 56px;
        }
        
        /* Mobile responsiveness */
        @media (max-width: 991.98px) {
            .content-wrapper {
                margin-left: 0 !important;
            }
        }

        /* Ensure CSS variables are available */
        :root {
            --primary: #9a3324;
            --secondary: #0c1e47;
            --accent1: #f26430;
            --accent2: #f7b71d;
            --light: #ffffff;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="d-flex min-vh-100 bg-light">
        <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
            @include('layouts.sidebar')
        </div>
        
        <div class="flex-grow-1 d-flex flex-column content-wrapper">
            <header class="header header-sticky mb-4">
                <div class="container-fluid">
                    <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" 
                            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                        <i class="cil-menu icon icon-lg"></i>
                    </button>
                    @include('layouts.header')
                </div>
            </header>
            
            <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                    @yield('content')
                </div>
            </div>
            
            <footer class="footer mt-auto">
                <div>© 2025 Your Company</div>
            </footer>
        </div>
    </div>
  
    
    
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js"
        integrity="sha384-8QmUFX1sl4cMveCP2+H1tyZlShMi1LeZCJJxTZeXDxOwQexlDrLQ3O9L78gwBbe"
        crossorigin="anonymous"></script>
    
    <script>
        // Keep your existing sidebar toggle functionality
        // Just ensure the content adjusts properly with CSS
    </script>
    @stack('scripts')
</body>

</html>