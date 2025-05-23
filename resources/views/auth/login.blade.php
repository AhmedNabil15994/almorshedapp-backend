<!DOCTYPE html>

<html lang="{{ locale() }}"  direction="{{ is_rtl() }}" dir="{{ is_rtl() }}" style="direction: {{ is_rtl() }}">

    <head>
        <meta charset="utf-8" />
        <title> {{ __('front.auth.title') }} || {{ config('app.name') }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--begin::Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
        @if (is_rtl() == 'rtl')
        <link href="{{ url('admin/login/assets/css/pages/login/login-4.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/skins/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/skins/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/skins/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/skins/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
        @else
        <link href="{{ url('admin/login/assets/css/pages/login/login-4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('admin/login/assets/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
        @endif
        <link rel="shortcut icon" href="" />
        <style>
            body {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    </head>

    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

        <div class="kt-grid kt-grid--ver kt-grid--root">
            <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ url('admin/login/assets/media/bg/bg-2.jpg')  }});">
                    <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                        <div class="kt-login__container">
                            <div class="kt-login__logo">
                                <a href="#">
                                    <img src="{{ url('uploads/logo.png') }}" style="height: 120px">
                                </a>
                            </div>
                            <div class="kt-login__signin">

                                <h5 class="title-login">{{__('front.auth.submit_login')}}</h5>
                                <p class="p-title-login">{{__('front.auth.login_msg')}}</p>
                                <form method="POST" class="kt-form" action="{{ route('login') }}">
                                    @csrf

                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="{{__('front.auth.email_placeholder')}}" name="email" autocomplete="off" value="{{ old('email') }}">
                                        @error('email')
                                        <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="input-group">
                                        <input class="form-control" type="password" placeholder="{{__('front.auth.password_placeholder')}}" name="password">
                                        @error('password')
                                        <div id="password-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row kt-login__extra">
                                        <div class="col">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('front.auth.remember_me') }}
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="kt-login__actions">
                                        <button id="kt_login_signin_submit" class="btn btn-brand btn-pill kt-login__btn-primary">{{__('front.auth.submit_login')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var KTAppOptions = {
                "colors": {
                    "state": {
                        "brand": "#5d78ff",
                        "dark": "#282a3c",
                        "light": "#ffffff",
                        "primary": "#5867dd",
                        "success": "#34bfa3",
                        "info": "#36a3f7",
                        "warning": "#ffb822",
                        "danger": "#fd3995"
                    },
                    "base": {
                        "label": [
                            "#c5cbe3",
                            "#a1a8c3",
                            "#3d4465",
                            "#3e4466"
                        ],
                        "shape": [
                            "#f0f3ff",
                            "#d9dffa",
                            "#afb4d4",
                            "#646c9a"
                        ]
                    }
                }
            };
        </script>
        <script src="{{ url('admin/login/assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ url('admin/login/assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
    </body>

    <!-- end::Body -->
</html>