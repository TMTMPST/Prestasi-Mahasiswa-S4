<div>
    <h1 class="mb-4">Login</h1>
    <p class="text-medium-emphasis mb-4">Sign in to your account</p>

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="cil-user"></i>
            </span>
            <input class="form-control @error('login') is-invalid @enderror" type="text" name="login_id"
                placeholder="Username / NIP / NIM" value="{{ old('login_id') }}" required autofocus>
            @error('login')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-4">
            <span class="input-group-text">
                <i class="cil-lock-locked"></i>
            </span>
            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                placeholder="Password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-flex justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
            Login
        </button>

        <div class="text-center">
            <span>Don't have an account? </span>
            <a href="#" class="text-decoration-none" id="signupLink">
                Sign up
            </a>
        </div>
    </form>
</div>
