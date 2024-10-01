@extends('layouts.admin')
@section('content')
@include('dashboard.master')

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="main">
                    <section class="sign-in">
                        <div class="signin-content">
                            <div class="signin-image">
                                <figure>
                                    <img src="{{ asset('images/signin-admin.jpeg') }}" alt="sign up image" />
                                </figure>
                            </div>

                            <div class="signin-form">
                                <h2 class="form-title">Admin Sign in</h2>
                                <form method="POST" action="{{ route('admin.login') }}" id="login-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Your Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="agree-term" />
                                        <label for="remember" class="label-agree-term">
                                            <span><span></span></span>
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    <div class="form-group form-button">
                                        <button type="submit" class="form-submit btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
