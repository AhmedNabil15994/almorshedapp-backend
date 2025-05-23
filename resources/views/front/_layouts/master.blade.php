<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}">
    @if (is_rtl() == 'rtl')
      @include('front._layouts._head_rtl')
    @else
      @include('front._layouts._head_ltr')
    @endif

    <body>
        <div class="wrapper">
            @include('front._layouts._header')

            <div class="site-main">
                @yield('content')
            </div>

            @include('front._layouts._footer')
        </div>
        @include('front._layouts._jquery')
    </body>
</html>
