<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}">

    @if (is_rtl() == 'rtl')
      @include('dashboard._layouts._head_rtl')
    @else
      @include('dashboard._layouts._head_ltr')
    @endif

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <div class="page-wrapper">

            @include('dashboard._layouts._header')

            <div class="clearfix"> </div>

            <div class="page-container">
                @include('dashboard._layouts._aside')

                @yield('content')
            </div>

            @include('dashboard._layouts._footer')
        </div>

        @include('dashboard._layouts._jquery')
        @include('dashboard._layouts._js')
    </body>
</html>
