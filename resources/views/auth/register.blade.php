@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/privacypolicy_termsandaggreement.css') }}" />
    <div class="container"
        style="height: 80%; display: block; justify-content: center; align-items: center; margin: 0 auto;">
        <div class="row justify-content-center  mt-4">
            <div class="card pt-4 shadow lg">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="card-body emailcard">
                        <div class="row justify-content-center">
                            <img class="logoimg" src="{{ asset('/images/logo.png') }}" alt="logo">
                            <h2 class="loginlbl fs-5">Sign-up Here</h2>

                            <div class="row flex justify-content-center mt-2">
                                <label for="email" class="label2">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="row flex justify-content-center mt-3">
                                <button id="hideButton1" type="button" class="btn btn-primary loginbtn">
                                    {{ __('Next') }}
                                </button>
                            </div>
                            <div class="row flex justify-content-center labelreglink">
                                <p class="labelreglink mt-1">Already have an account? <a class="btn registerlink"
                                        href="{{ route('login') }}"> Login</a>
                            </div>

                        </div>
                    </div>


                    <div class="card-body namecard">
                        <button id="back1" class="back1">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>

                        <div class="row justify-content-center">
                            <img class="logoimg" src="{{ asset('/images/logo.png') }}" alt="logo">
                            <h2 class="loginlbl fs-5">Sign-up Here</h2>
                        </div>
                        <div class="row flex justify-content-center">
                            <label for="firstname" class="label">{{ __('Firstname') }}</label>
                            <input name="firstname" id="firstname" type="text"
                                class="form-control @error('firstname') is-invalid @enderror"
                                value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="row flex justify-content-center mt-4">
                            <label for="lastname" class="label">{{ __('Lastname') }}</label>

                            <input name="lastname" id="lastname" type="text"
                                class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}"
                                required autocomplete="lastname" autofocus>

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row flex justify-content-center">
                            <button id="hideButton2" type="button" class="btn btn-primary loginbtn">
                                {{ __('Next') }}
                            </button>
                        </div>
                        <div class="row flex justify-content-center labelreglink">
                            <p class="labelreglink mt-1">Already have an account? <a class="btn registerlink"
                                    href="{{ route('login') }}"> Login</a>
                        </div>

                    </div>

                    {{-- Register Password --}}

                    <div class="card-body passwordcard">
                        <button id="back2" class="back1">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <div class="row justify-content-center">
                            <img class="logoimg" src="{{ asset('/images/logo.png') }}" alt="logo">
                            <h2 class="loginlbl fs-5">Sign-up Here</h2>
                        </div>

                        <div class="row flex justify-content-center">
                            <label for="password" class="label">{{ __('Password') }}</label>
                            <input name="password" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row flex justify-content-center mt-4">
                            <label style="margin-left: -13.5rem" for="password-confirm"
                                class="label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>

                        <div class="container d-flex justify-content-center pb-2">
                            <div class="form-check mt-1 d-flex justify-content-center">
                                <input class="form-check-input ms-2" type="checkbox" value=""
                                    id="flexCheckDefault" required>
                                <label class="form-check-label labelreglink"
                                    for="flexCheckDefault">
                                    <span style="font-weight: 300; ">By signing up, I agree to the <a type="button"
                                            id="TCButton"><i>Terms &
                                                Conditions</i></a> and <a type="button" id="PPButton"><i>Privacy
                                                Policy.</i></a></span>
                                </label>
                            </div>
                        </div>

                        <div class="row flex justify-content-center ">
                            <button type="submit" class="btn btn-primary loginbtn">
                                {{ __('Register') }}
                            </button>
                        </div>
                        <div class="row flex justify-content-center labelreglink">
                            <p class="labelreglink mt-1">Already have an account? <a class="btn registerlink"
                                    href="{{ route('login') }}"> Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @include('partials.footer')

    <script>
        $(document).ready(function() {
            $("#TCButton").on("click", function(e) {
                e.preventDefault();
                window.open('/terms-and-conditions', '_blank');
            })

            $("#PPButton").on("click", function(e) {
                e.preventDefault();
                window.open('/privacy-policy', '_blank');
            })
        });
    </script>
@endsection
