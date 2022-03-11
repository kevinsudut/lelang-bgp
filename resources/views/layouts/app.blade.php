@inject('CarbonFormater', '\App\Helpers\DateTime\CarbonFormater')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="url" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lelang BGP</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/icon144.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script>
        const BASE_URL = "{{ url('/') }}"
    </script>
</head>

<body>
    <header>
        <div class="container">
            <div class="d-inline-block">
                <div class="d-flex justify-content-between w-100">
                    <img class="ml-2 pointer" id="logo" src="{{ asset('assets/a85c79fc.png') }}" onclick="location.href='{{ url('/') }}'" alt="logo">
                    <div id="app-name">
                        Lelang BGP
                    </div>
                </div>
            </div>

            <span class="float-right" id="salutation">
                <b>
                    <span class="cursor">Halo</span>
                    <span class="blue">{{ auth()->user()->name }}</span>
                </b>
            </span>
            <span class="float-right rounded" id="time-container">
                <b>
                    <span id="time">{{ $CarbonFormater->toGMT() }}</span>
                </b>
            </span>
        </div>
    </header>

    <nav class="my-navbar sticky-top" id="large">
        <div class="container d-flex justify-content-between py-0">
            <div class="navbar-scroll">
                <span class="menu">
                    <a href="{{ url('/') }}">Home</a>
                </span>
            </div>

            <div>
                <span class="menu">
                    <a href="{{ url('auth/logout') }}">
                        <span>Sign Out</span>
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </span>
            </div>
        </div>
    </nav>

    <div class="container my-3" id="main">
        @yield('content')
    </div>

    <script src="{{ asset('js/time.js') }}"></script>
</body>

</html>
