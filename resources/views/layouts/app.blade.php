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
    <script src="{{ asset('js/message.js') }}"></script>
    <script>
        const BASE_URL = "{{ url('/') }}"
    </script>
</head>

<body>
    <div id="message">
        <div class="p-3 text-white">
            <button type="button" class="btn-close btn-close-white btn-close" id="message-close" aria-label="Close"></button>
            <strong id="message-content"></strong>
        </div>
    </div>

    <script>
        @if ($errors->any())
        $.message('bg-danger', "{!! $errors->first() !!}")
        @endif
        @if (session()->has('success'))
        $.message('bg-success', "{!! session()->get('success') !!}")
        @php
            session()->forget('success');
        @endphp
        @endif
    </script>

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

    <nav class="my-navbar sticky-top" id="small" style="display: none;">
        <div class="container navbar navbar-light bg-white d-flex justify-content-between" style="box-shadow: 0px 1px 1px 1px #ddd;">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#responsiveNavbarToggle"
                    aria-controls="responsiveNavbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex">
                <span class="menu">
                    <a href="{{ url('auth/logout') }}">
                        <span>Sign Out</span>
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </span>
            </div>
        </div>

        <div class="navbar-collapse collapse" id="responsiveNavbarToggle">
            <div class="container bg-white p-4" style="max-height: 60vh; overflow-y: auto">
                <span class="menu menu-responsive">
                    <a href="{{ url('/') }}">Home</a>
                </span>
                <span class="menu menu-responsive">
                    <a href="{{ url('wallet') }}">My Wallet</a>
                </span>
                <span class="menu menu-responsive">
                    <a href="{{ url('product/my') }}">My Product</a>
                </span>
                <span class="menu menu-responsive">
                    <a href="{{ url('product/my-bid') }}">My Bidding</a>
                </span>
            </div>
        </div>
    </nav>

    <nav class="my-navbar sticky-top" id="large">
        <div class="container d-flex justify-content-between py-0">
            <div class="navbar-scroll">
                <span class="menu">
                    <a href="{{ url('/') }}">Home</a>
                </span>
                <span class="menu">
                    <a href="{{ url('wallet') }}">My Wallet</a>
                </span>
                <span class="menu">
                    <a href="{{ url('product/my') }}">My Product</a>
                </span>
                <span class="menu">
                    <a href="{{ url('product/my-bid') }}">My Bidding</a>
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

    <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Permanently</h4>
                    <button type="button" class="btn-close btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure about this ?</p>
                    <form action="" method="post" id="form-delete" class="d-none">
                        @csrf
                        <input type="hidden" name="id" required>
                        <button>Click</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirm">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            $('#confirmDelete').on('show.bs.modal', function (e) {
                var form = $(e.relatedTarget).closest('form').eq(0)
                var action = form.attr('action')
                var id = form.find("input[name='id']").val()
                $(this).find('#form-delete').attr('action', action)
                $(this).find("#form-delete input[name='id']").attr('value', id)
            })
            $('#confirmDelete').on('click', '#confirm', function (e) {
                $('#confirmDelete').find('#form-delete').submit()
            })
        })()
    </script>

    <script src="{{ asset('js/time.js') }}"></script>
</body>

</html>
