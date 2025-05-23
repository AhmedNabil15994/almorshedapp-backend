<header class="site-header header-option">
    <div class="header-top">
        <div class="container">
            <div class="topp">
                <ul class="header-top-left">

                    <li class="menu-item-has-children arrow">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if ($localeCode == locale())
                        <a href="javascript:;"> {{ $properties['native'] }} </a>
                        @endif
                        @endforeach
                        <ul class="submenu dropdown-menu">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if ($localeCode != locale())
                            <li>
                                <a hreflang="{{ $localeCode }}" href="{{LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class="header-top-right">
                    <li></li>
                </ul>
            </div>

        </div>
    </div>
</header>
