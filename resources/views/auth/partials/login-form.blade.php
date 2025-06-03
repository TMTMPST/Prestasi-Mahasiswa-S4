<div>
    <div class="auth-side login-side">
        <div class="auth-content">
            <h2 class="auth-title">Login</h2>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="form-floating">
                    <input class="form-control @error('login') is-invalid @enderror" type="text" name="login_id"
                        placeholder="NIM/Username" value="{{ old('login_id') }}" required autofocus>
                    <label for="loginUsername">NIM/Username</label>
                    @error('login')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                        placeholder="Password" required autocomplete="current-password">
                    <label for="loginPassword">Password</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Ingat saya
                    </label>
                </div>
                <button type="submit" class="btn btn-auth">Login</button>
            </form>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">
                    Forgot password?
                </a>
            @endif
            <div class="auth-footer">
                <p>Lupa password? <a href="#">Reset disini</a></p>
                <p>Belum punya akun? <a class="toggle-auth">Daftar sekarang</a></p>
            </div>
        </div>
        <div class="auth-image">
            <h2>Selamat Datang Kembali!</h2>
            <p>Masuk ke akun Anda untuk mengakses portal prestasi mahasiswa POLINEMA.</p>
        </div>
    </div>
</div>