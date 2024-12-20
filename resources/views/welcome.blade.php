<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SAMS</title>

        <!-- External JS -->
        <script src="{{ asset('assets/js/login.js') }}"></script>

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- External CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <style>
            body {
                color: #444;
                background: linear-gradient(to right, rgba(30, 67, 86, 0.8), rgba(30, 67, 86, 0.6)), url('{{ asset('images/bg.jpg') }}') center top no-repeat;
            }
        </style>
    </head>
    <body>
    <div class="login">
    <div class="form-container">
        <div class="login-container" id="login-container">
            <h1 class="title">Welcome To Student Academic Monitoring System</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                <br><label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                <br><div class="account-controls">
                    <button type="submit" class="fas fa-solid fa-angle">
                        {{ __('Login') }}
                    </button><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        <span class="signup-text">Don't have an account yet? <a id = "signup-form-toggler">Sign up</a></span>
    </div>

    <div class="placeholder-banner"  id="banner">
        <img src={{ asset('images/login.jpg') }} alt="" class="banner">
    </div>

        <!--Sign up form-->
        <div class="signup-container" id="signup-container" style="transform: scale(0);">
            <h1 class="title">Signup</h1>
            <p class="desc">Create your account to keep track the progress</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                    <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    <label for="email">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                <div class="account-controls">
                    <br><button type="submit" class="fas fa-solid fa-angle">
                        {{ __('Register') }}
                    </button><br>
                </div>
            </form>
            <span class="signup-text">Already have an account? <a id = "login-form-toggler">Login here</a></span>
        </div>
    </div>
    </div>
    </body>
</html>
