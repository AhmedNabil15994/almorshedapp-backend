<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>

            <li class="nav-item start active">
                <a href="{{ url(route('dashboard')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ __('dashboard.aside.dashboard') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">{{ __('dashboard.aside.users_tab') }}</h3>
            </li>

            @permission('show_roles')
            <li class="nav-item">
                <a href="{{ url(route('permissions.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.permissions') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_roles')
            <li class="nav-item">
                <a href="{{ url(route('roles.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.roles') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_users')
            <li class="nav-item">
                <a href="{{ url(route('users.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.users') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_doctors')
            <li class="nav-item">
                <a href="{{ url(route('doctors.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.doctors') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_assessments')
            <li class="nav-item">
                <a href="{{ url(route('assessments.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.assessments') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_reservations')
            <li class="nav-item">
                <a href="{{ url(route('reservations.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.reservations') }}</span>
                </a>
            </li>
            @endpermission

            <li class="heading">
                <h3 class="uppercase">{{ __('dashboard.aside.store') }}</h3>
            </li>

            @permission('show_categories')
            <li class="nav-item">
                <a href="{{ url(route('categories.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.categories') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_services')
            <li class="nav-item">
                <a href="{{ url(route('services.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.services') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_orders')
            <li class="nav-item">
                <a href="{{ url(route('order-statuses.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.orderStatuses') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_articles')
            <li class="nav-item">
                <a href="{{ url(route('articles.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.articles') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_ads')
            <li class="nav-item">
                <a href="{{ url(route('ads.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.ads') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_languages')
            <li class="nav-item">
                <a href="{{ url(route('languages.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.languages') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_pages')
            <li class="nav-item">
                <a href="{{ url(route('pages.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.pages') }}</span>
                </a>
            </li>
            @endpermission

            <li class="heading">
                <h3 class="uppercase">{{ __('dashboard.aside.settings_tab') }}</h3>
            </li>

            @permission('show_notifications')
            <li class="nav-item">
                <a href="{{ url(route('notification.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.notifications') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_reports')
            <li class="nav-item">
                <a href="{{ url(route('reports.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.reports') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_settings')
            <li class="nav-item">
                <a href="{{ url(route('settings.index')) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.settings_tab') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_translations')
            <li class="nav-item">
                <a href="{{ url(route('languages.translations.index',locale())) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.translations') }}</span>
                </a>
            </li>
            @endpermission

            @permission('show_logs')
            <li class="nav-item">
                <a href="{{ url('log-viewer') }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">{{ __('dashboard.aside.logs') }}</span>
                </a>
            </li>
            @endpermission

        </ul>
    </div>
</div>
