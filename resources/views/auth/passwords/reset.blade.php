@extends('layouts.app')

@section('title')
Reset Password
@endsection

@section('content')
<div class="kt-login__signin">

    <h5 class="title-login">{{ __('front.auth.Reset Password') }}</h5>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" class="kt-form" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-group">
            <input class="form-control" type="email" placeholder="{{__('front.auth.email_placeholder')}}" name="email"  value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <input class="form-control" type="password" placeholder="{{__('front.auth.password_placeholder')}}" name="password" required autocomplete="new-password">
            @error('password')
            <div id="password-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <input class="form-control" type="password" placeholder="{{ __('front.auth.Confirm Password') }}" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="kt-login__actions">
            <button id="kt_login_signin_submit" class="btn btn-brand btn-pill kt-login__btn-primary">{{ __('front.auth.Reset Password') }}</button>
        </div>
    </form>
</div>
@endsection
