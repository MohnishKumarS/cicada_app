@extends('layouts.main')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <!-- update password -->
    <section>
        <div class="custom-acc">
            <div class="container">
                <div class="row justify-content-center px-3 px-sm-0">
                    <div class="col-lg-6 col-md-10 col-12">
                        <div>
                            <h1 class="custom-acc__head page--head mb-0">Set Your New Password</h1>
                            <p class="custom-acc__desc">Choose a new password and keep your account safe and secure.</p>
                  

                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                        placeholder="name@example.com">
                                    <label for="email">Email Address</label>
                                    @error('email')
                                    <div class="text-danger pt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="newPass" name="password"  required autocomplete="new-password"
                                        placeholder="name@example.com">
                                    <label for="newPass">Password</label>
                                    @error('password')
                                    <div class="text-danger pt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="confirmPass" name="password_confirmation"  required autocomplete="new-password"
                                        placeholder="name@example.com">
                                    <label for="confirmPass">Confirm Password</label>
                                </div>
                               

                                <div class="custom-acc__btns text-center">
                                    <button type="submit" class="btn-main">Reset Password</button>
                                    <div class="custom-acc__page">
                                        <a href="{{ route('login') }}" class="link link--text">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
