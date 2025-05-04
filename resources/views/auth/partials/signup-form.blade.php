<div>
    <h1 class="mb-4">Sign Up</h1>
    <p class="text-medium-emphasis mb-4">Create your account</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="cil-user"></i>
            </span>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                placeholder="Full Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="cil-envelope-closed"></i>
            </span>
            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="cil-lock-locked"></i>
            </span>
            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                placeholder="Password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-4">
            <span class="input-group-text">
                <i class="cil-lock-locked"></i>
            </span>
            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password"
                required autocomplete="new-password">
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="terms" id="termsCheck" required>
            <label class="form-check-label" for="termsCheck">
                I agree to the terms and conditions
            </label>
        </div>

        <button type="submit" class="btn btn-success w-100 mb-3">
            Create Account
        </button>

        <div class="text-center">
            <span>Already have an account? </span>
            <a href="#" class="text-decoration-none" id="loginLink">
                Login
            </a>
        </div>
    </form>
</div>