@extends('layouts.auth.auth')

@section('content')
<div class="item-center">
    <form name="formAuth" class="form-auth" id="form-auth" method="POST" autocomplete="off">
        @csrf
        <span class="logo-tokopedia"></span>

        <h4 class="mt-2">Lelang BGP | Register Account</h4>

        <div class="input-control">
            <input name="name" placeholder="Name" value="{{ old('name') }}" tabindex="1" required="" autofocus="">
            <i class="fa fa-user"></i>
        </div>

        <div class="input-control">
            <input name="email" placeholder="E-Mail" value="{{ old('email') }}" tabindex="2" required="" autofocus="">
            <i class="fa fa-user"></i>
        </div>

        <div class="input-control">
            <input name="password" type="password" placeholder="Password" tabindex="3" required="">
            <i class="fa fa-lock"></i>
        </div>

        <div class="input-control">
            <input name="password_confirmation" type="password" placeholder="Confirm Password" tabindex="4" required="">
            <i class="fa fa-lock"></i>
        </div>

        <button tabindex="4">Register</button>

        @if ($errors->any())
            <div class="bg-danger mt-3 p-1">
                <div class="text-center text-white my-2">{{ $errors->first() }}</div>
            </div>
        @endif

        <div class="text-center mt-2" id="register-link">
            <a href="{{ url('auth/login') }}">Have an Account? Click here to login</a>
        </div>
    </form>
</div>
@endsection
