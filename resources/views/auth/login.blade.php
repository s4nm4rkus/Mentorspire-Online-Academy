@extends('layouts.app')
@section('content')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <div class="container" style=" display: block; justify-content: center; align-items: center; margin: 0 auto;">
        <div class="row justify-content-center  mt-4 logincss">

            <div class="card pt-4 shadow-lg">

                <style>
                    .card {
                        width: 30rem;
                    }

                    @media only screen and (max-width: 768px) {
                        .card {
                            width: 100%;
                        }
                    }
                </style>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <img class="logoimg" src="{{ asset('/images/logo.png') }}" alt="logo">
                        <h2 class="loginlbl fs-5">Log-in Here</h2>
                        <label for="email" class="labelemail">{{ __('Email Address') }}</label>
                        <div class="d-flex justify-content-center">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span style="position:absolute; margin-top: 3rem; font-size: 12px;" class="invalid-feedback"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <label for="password" class="label mt-4">{{ __('Password') }}</label>
                        <div class="d-flex justify-content-center">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary loginbtn">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <p class="labelreglink mt-1">Don’t have an account yet?<a class="btn registerlink"
                                href="{{ route('register') }}">Register</a>

                    </form>
                </div>
            </div>
        </div>

    </div>
    @include('partials.footer')
@endsection
