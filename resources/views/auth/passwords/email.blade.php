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

    <form method="POST" class="kt-form" action="{{ route('password.email') }}">
        @csrf

        <div class="input-group">
            <input class="form-control" type="email" placeholder="{{__('front.auth.email_placeholder')}}" name="email" autocomplete="off" value="{{ old('email') }}" required>
            @error('email')
            <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
            @enderror
        </div>

        <div class="kt-login__actions">
            <button id="kt_login_signin_submit" class="btn btn-brand btn-pill kt-login__btn-primary">{{ __('front.auth.Send Password Reset Link') }}</button>
        </div>
    </form>
</div>
@endsection
