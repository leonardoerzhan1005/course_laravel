@php
    $nav_menu = menu_get_by_slug('nav-menu');
    $categories = \Modules\Course\app\Models\CourseCategory::with('translation')
        ->where('status', 1)
        ->whereNull('parent_id')
        ->get();
@endphp
<!-- header-area -->
<header>
    @if ($setting?->header_topbar_status == 'active')
        <div class="bg-dark text-white py-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            @if ($setting?->site_address)
                                <li class="list-inline-item me-3">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    <span>{{ $setting?->site_address }}</span>
                                </li>
                            @endif
                            @if ($setting?->site_email)
                                <li class="list-inline-item">
                                    <i class="fas fa-envelope me-1"></i>
                                    <a href="mailto:{{ $setting?->site_email }}" class="text-white text-decoration-none">{{ $setting?->site_email }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-end align-items-center">
                            @if ($setting?->header_social_status == 'active')
                                <ul class="list-inline mb-0 me-3">
                                    <li class="list-inline-item">{{ __('Follow Us On') }} :</li>
                                    @foreach (getSocialLinks() as $socialLink)
                                        <li class="list-inline-item">
                                            <a href="{{ $socialLink->link }}" target="_blank" class="text-white text-decoration-none">
                                                <img src="{{ asset($socialLink->icon) }}" alt="img" style="width: 20px; height: 20px;">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="d-flex gap-2">
                                @if (count(allLanguages()?->where('status', 1)) > 1)
                                    <form action="{{ route('set-language') }}" id="setLanguageHeader" class="d-inline">
                                        <select name="code" class="form-select form-select-sm" style="width: auto;">
                                            @forelse (allLanguages()?->where('status', 1) as $language)
                                                <option value="{{ $language->code }}"
                                                    {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                                                    {{ $language->name }}
                                                </option>
                                            @empty
                                                <option value="en"
                                                    {{ getSessionLanguage() == 'en' ? 'selected' : '' }}>
                                                    {{ __('English') }}
                                                </option>
                                            @endforelse
                                        </select>
                                    </form>
                                @endif
                                @if (count(allCurrencies()?->where('status', 'active')) > 1)
                                    <form action="{{ route('set-currency') }}" class="set-currency-header d-inline" method="GET">
                                        <select name="currency" class="change-currency form-select form-select-sm" style="width: auto;">
                                            @forelse (allCurrencies()?->where('status', 'active') as $currency)
                                                <option value="{{ $currency->currency_code }}"
                                                    {{ getSessionCurrency() == $currency->currency_code ? 'selected' : '' }}>
                                                    {{ $currency->currency_name }}
                                                </option>
                                            @empty
                                                <option value="USD"
                                                    {{ getSessionCurrency() == 'USD' ? 'selected' : '' }}>
                                                    {{ __('USD') }}
                                                </option>
                                            @endforelse
                                        </select>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset($setting?->logo) }}" alt="Logo" height="40">
            </a>

            <!-- Search Form -->


            <!-- Navigation Menu -->
            <div class="navbar-nav me-auto">
                @if ($nav_menu)
                    @foreach ($nav_menu->menuItems as $menu)
                        @if ($menu?->link == '/' && $setting?->show_all_homepage == 1)
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ url('/') }}" role="button" data-bs-toggle="dropdown">
                                    {{ __('Home') }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach (App\Enums\ThemeList::cases() as $theme)
                                        <li><a class="dropdown-item" href="{{ route('change-theme', $theme->value) }}">{{ __($theme->value) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            @if ($menu->child && count($menu->child))
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        {{ $menu?->label }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach ($menu?->child as $child)
                                            <li><a class="dropdown-item" href="{{ url($child?->link) }}">{{ $child?->label }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <a class="nav-link" href="{{ url($menu?->link) }}">{{ $menu?->label }}</a>
                            @endif
                        @endif
                    @endforeach
                @endif
            </div>

            <!-- Right Side Actions -->
            <div class="navbar-nav ms-auto">
                <!-- Cart -->
                

                <!-- User Menu -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @auth('admin')
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __('Admin Dashboard') }}</a></li>
                        @endauth
                        @guest
                            <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('Sign in') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('Sign Up') }}</a></li>
                        @else
                            @if (Auth::guard('web')->user())
                                @if (instructorStatus() == 'approved')
                                    <li><a class="dropdown-item" href="{{ route('instructor.dashboard') }}">{{ __('Instructor Dashboard') }}</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('student.dashboard') }}">{{ __('Student Dashboard') }}</a></li>
                                <li><a class="dropdown-item" href="{{ userAuth()->role == 'instructor' ? route('instructor.setting.index') : route('student.setting.index') }}">{{ __('Profile') }}</a></li>
                                <li><a class="dropdown-item" href="{{ userAuth()->role == 'instructor' ? route('instructor.courses.index') : route('student.enrolled-courses') }}">{{ __('Courses') }}</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger logout-btn" href="#">{{ __('Logout') }}</a></li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMobile">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="collapse navbar-collapse" id="navbarMobile">
            <div class="container">
                <!-- Mobile Search -->
                <form action="{{ route('courses') }}" class="d-md-none mb-3">
                    <div class="input-group">
                        <select class="form-select" name="main_category">
                            <option selected disabled>{{ __('Categories') }}</option>
                            @foreach ($categories as $category)
                                <option @selected(request('main_category') == $category->slug) value="{{ $category->slug }}">
                                    {{ $category?->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" placeholder="{{ __('Search here') }}..." name="search">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Mobile Language/Currency -->
                <div class="d-md-none mb-3">
                    <div class="row">
                        @if (count(allLanguages()?->where('status', 1)) > 1)
                            <div class="col-6">
                                <form action="{{ route('set-language') }}" class="change-language-header-mobile">
                                    <select name="code" class="form-select set-language-header-mobile">
                                        @forelse (allLanguages()?->where('status', 1) as $language)
                                            <option value="{{ $language->code }}"
                                                {{ getSessionLanguage() == $language->code ? 'selected' : '' }}>
                                                {{ $language->name }}
                                            </option>
                                        @empty
                                            <option value="en"
                                                {{ getSessionLanguage() == 'en' ? 'selected' : '' }}>
                                                {{ __('English') }}
                                            </option>
                                        @endforelse
                                    </select>
                                </form>
                            </div>
                        @endif
                        @if (count(allCurrencies()?->where('status', 'active')) > 1)
                            <div class="col-6">
                                <form action="{{ route('set-currency') }}" class="change-currency-header-mobile">
                                    <select name="currency" class="set-currency-header-mobile form-select">
                                        @forelse (allCurrencies()?->where('status', 'active') as $currency)
                                            <option value="{{ $currency->currency_code }}"
                                                {{ getSessionCurrency() == $currency->currency_code ? 'selected' : '' }}>
                                                {{ $currency->currency_name }}
                                            </option>
                                        @empty
                                            <option value="USD"
                                                {{ getSessionCurrency() == 'USD' ? 'selected' : '' }}>
                                                {{ __('USD') }}
                                            </option>
                                        @endforelse
                                    </select>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Mobile Social Links -->
                @if (count(getSocialLinks()) > 0)
                    <div class="d-md-none mb-3">
                        <h6 class="text-muted">{{ __('Follow Us') }}</h6>
                        <div class="d-flex gap-2">
                            @foreach (getSocialLinks() as $socialLink)
                                <a href="{{ $socialLink->link }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                    <img src="{{ asset($socialLink->icon) }}" alt="img" style="width: 16px; height: 16px;">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    {{-- start admin logout form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    {{-- end admin logout form --}}
</header>
<!-- header-area-end -->
