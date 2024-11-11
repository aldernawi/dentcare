@extends('layouts.home.app')

@section('content')
    {{ $noFooter = '' }}
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .card {
            background-color: var(--body-color);
            margin: 20px;
            border: none;
        }

        @keyframes rotate {
            50% {

                border-image: linear-gradient(360deg, #05aafd, #2468dd, #1256e9) 1;
            }
        }

        .box {
            width: 500px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, 20%);
            background: var(--body-color);

            text-align: center;
            transition: 0.25s;
            border: 5px solid;
            border-image: linear-gradient(#59ffd8, #dd2476, #1c64ff) 1;
            animation: rotate 2.5s ease-in infinite;
            color: var(--black-color);
            font-size: 20px;

        }

        .box input[type="text"],
        .box input[type="password"],
        .box input[type="email"],
        .box input[type="Date"],
        .box input[type="file"] {
            background: var(--body-color);
            border: 0;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #3498db;
            padding: 10px 10px;
            width: 250px;
            outline: none;
            color: black;
            border-radius: 24px;
            transition: 0.25s
        }

        .box h1 {
            color: var(--black-color);
            text-transform: uppercase;
            font-weight: 500
        }

        .box input[type="text"]:focus,
        .box input[type="password"]:focus,
        .box input[type="email"]:focus {
            color: var(--black-color);
            background-color: #191919;
            width: 300px;
            border-color: #2ecc71
        }

        .box input[type="submit"] {
            border: 0;
            background: none;

            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            padding: 14px 40px;
            outline: none;
            color: black;
            border-radius: 24px;
            transition: 0.25s;
            cursor: pointer
        }

        .box input[type="submit"]:hover {
            background: #2ecc71;
            color: var(--black-color);
        }

        .forgot {
            text-decoration: underline
        }

        ul.social-network {
            list-style: none;
            display: inline;
            margin-left: 0 !important;
            padding: 0
        }

        ul.social-network li {
            display: inline;
            margin: 0 5px
        }

        .social-network a.icoFacebook:hover {
            background-color: #3B5998
        }

        .social-network a.icoTwitter:hover {
            background-color: #33ccff
        }

        .social-network a.icoGoogle:hover {
            background-color: #BD3518
        }

        .social-network a.icoFacebook:hover i,
        .social-network a.icoTwitter:hover i,
        .social-network a.icoGoogle:hover i {
            color: var(--black-color);
        }

        a.socialIcon:hover,
        .socialHoverClass {
            color: #44BCDD
        }

        .social-circle li a {
            display: inline-block;
            position: relative;
            margin: 0 auto 0 auto;
            border-radius: 50%;
            text-align: center;
            width: 50px;
            height: 50px;
            font-size: 20px
        }

        .social-circle li i {
            margin: 0;
            line-height: 50px;
            text-align: center
        }

        .social-circle li a:hover i,
        .triggeredHover {
            transform: rotate(360deg);
            transition: all 0.2s
        }

        .social-circle i {
            color: #fff;
            transition: all 0.8s;
            transition: all 0.8s;
        }

        .card {
            background-color: transparent
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <!-- Form for login -->
                    <form method="POST" action="{{ route('login') }}" class="box loginForm" autocomplete="off">
                        @csrf
                        @method('post')
                        <h1 class="m-5 ">{{ __('Login') }}</h1>
                        <input type="email" name="email" class="@error('email') is-invalid @enderror" required
                            placeholder="{{ __('Email Address') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="password" class="@error('password') is-invalid @enderror" name="password" required
                            placeholder="{{ __('Password') }}">

                        <input type="submit" name="login" value="{{ __('Login') }}">
                        <p class="">{{ __('Don\'t have an account?') }} <a id="SignToggle"
                                href="#">{{ __('Register') }}</a></p>
                    </form>

                    <!-- Form for registration -->
                    <form class="box SignForm" method="POST" action="{{ route('register') }}" autocomplete="off"
                        style="display:none">
                        @csrf
                        @method('post')
                        <h1 class="m-5 ">{{ __('Register Account') }}</h1>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror" required
                            placeholder="{{ __('Name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="email" name="email" placeholder="{{ __('Email Address') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="password" name="password" class="@error('password') is-invalid @enderror"
                            placeholder="{{ __('Password') }}" required>
                        <input type="password" class="@error('password_confirmation') is-invalid @enderror"
                            placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required>
                        <input type="Date" class="@error('birth') is-invalid @enderror"
                            placeholder="{{ __('Birth Day') }}" name="birth" required>
                        <input type="file" class="@error('img') is-invalid @enderror" placeholder="{{ __('Image') }}"
                            name="img" required>
                        <input type="submit" name="reg" value="{{ __('Register') }}">
                        <p class="">{{ __('Already have an account?') }} <a id="LoginToggle"
                                href="#">{{ __('Login') }}</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#SignToggle").on("click", function(e) {

            e.preventDefault();
            var div = $(".loginForm");

            div.slideUp(1500, 'linear', function() {
                var div2 = $(".SignForm");
                div2.slideDown(1500, 'linear');
            });
        });

        $("#LoginToggle").on("click", function(e) {
            e.preventDefault();
            var div = $(".SignForm");
            div.slideUp(1500, 'linear', function() {

                var div2 = $(".loginForm");
                div2.slideDown(1500, 'linear');
            });
        });
    </script>
@endsection
