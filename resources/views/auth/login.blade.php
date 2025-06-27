@extends('layouts.main')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <section>
        <div class="custom-acc">
            <div class="container">
                <div class="row justify-content-center px-3 px-sm-0">
                    <div class="col-lg-6 col-md-10 col-12">
                        <div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <h1 class="custom-acc__head page--head">Login</h1>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="email" placeholder="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    <label for="floatingInput">Email address</label>
                                    @error('email')
                                        {{-- <script>
                                            $.Toast("Oops!", "Incorrect usermail or password", "error", {
                                                timeout: 6000,
                                                has_progress: true,
                                            });
                                        </script> --}}
                                        <span class="text-danger">
                                            Incorrect usermail or password
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-2 position-relative">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                                        required autocomplete="current-password">
                                    <label for="password">Password</label>
                                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePassword()" style="cursor:pointer;">
                                        <i class="fa fa-eye" id="toggleIcon"></i>
                                    </span>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <p class="custom-acc__reset">
                                    <a href="{{ route('password.request') }}" class="link link--text">Forgot your
                                        password?</a>
                                </p>
                                <div class="custom-acc__btns text-center">
                                    <button class="btn-main">Sign In</button>
                                    <div class="custom-acc__page">
                                        <a href="{{ route('register') }}" class="link link--text">Create account</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<script>
    function togglePassword() {
        const input = document.getElementById("password");
        const icon = document.getElementById("toggleIcon");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    </script>
@endsection
