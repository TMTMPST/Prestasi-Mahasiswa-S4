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

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Custom Styles -->
    @stack('styles')
</head>

<body>
    <div>
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CoreUI JS -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js"
        integrity="sha384-8QmUFX1sl4cMveCP2+H1tyZlShMi1LeZCJJxTZeXDxOwQexlDrLQ3O9L78gwBbe"
        crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    @stack('scripts')
</body>

</html>