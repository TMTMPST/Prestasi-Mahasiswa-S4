@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card p-4 overflow-hidden">
                    <div class="card-body p-4 position-relative">
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
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
@endpush

@push('scripts')
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
@endpush
