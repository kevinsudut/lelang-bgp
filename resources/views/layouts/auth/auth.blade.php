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
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/particles.min.js') }}"></script>
    <script>
        const BASE_URL = "{{ url('/') }}"
    </script>
</head>

<body class="container auth-container">

<div id="particles-js"></div>

<div class="info">
    <div>
        <i class="fa fa-clock"></i>
        <span id="time">{{ $CarbonFormater->toGMT() }}</span>
    </div>
</div>

@yield('content')

<footer class="text-center">
    <span>Copyright © {{ \Carbon\Carbon::now()->year }}</span>
    <br>
    <span>Lelang BGP | Buyer Growth Platform</span>
</footer>

<script src="{{ asset('js/time.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
