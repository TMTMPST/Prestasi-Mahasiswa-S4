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

    <title>Login</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        .forms-container {
            position: relative;
            height: 340px;
            transition: height 0.5s ease-in-out;
        }
        
        .form-wrapper {
            position: absolute;
            width: 100%;
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }
        
        #loginForm {
            transform: translateX(0);
            opacity: 1;
        }
        
        #signupForm {
            transform: translateX(100%);
            opacity: 0;
        }
        
        .forms-container.show-signup {
            height: 460px;
        }
        
        .forms-container.show-signup #loginForm {
            transform: translateX(-100%);
            opacity: 0;
        }
        
        .forms-container.show-signup #signupForm {
            transform: translateX(0);
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card p-4 overflow-hidden">
                        <div class="card-body p-4 position-relative">
                            <div class="text-center mb-4">
                                <h2>SIMPRES</h2>
                            </div>
                            <div class="forms-container" id="formsContainer">
                                <div class="form-wrapper" id="loginForm">
                                    @include('auth.partials.login-form')
                                </div>
                                <div class="form-wrapper" id="signupForm">
                                    @include('auth.partials.signup-form')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <p class="text-muted">© 2025 SIMPRES</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js"
        integrity="sha384-8QmUFX1sl4cMveCP2+H1tyZlShMi1LeZCJJxTZeXDxOwQexlDrLQ3O9L78gwBbe"
        crossorigin="anonymous"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginLink = document.getElementById('loginLink');
            const signupLink = document.getElementById('signupLink');
            const formsContainer = document.getElementById('formsContainer');
            
            signupLink.addEventListener('click', function(e) {
                e.preventDefault();
                formsContainer.classList.add('show-signup');
            });
            
            loginLink.addEventListener('click', function(e) {
                e.preventDefault();
                formsContainer.classList.remove('show-signup');
            });
        });
    </script>
</body>

</html>