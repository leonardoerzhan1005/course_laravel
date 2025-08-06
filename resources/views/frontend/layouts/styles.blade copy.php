<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/flaticon-skillgro.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/default-icons.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/odometer.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/plyr.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/spacing.css') }}">
@if ($setting?->cursor_dot_status == 'active')
    <link rel="stylesheet" href="{{ asset('frontend/css/tg-cursor.css') }}">
@endif
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('global/nice-select/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/main.min.css') }}?v={{ $setting?->version }}">
<link rel="stylesheet" href="{{ asset('frontend/css/frontend.min.css') }}?v={{ $setting?->version }}">

<!-- Bootstrap Button Override -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-buttons-override.css') }}?v={{ $setting?->version }}">

@if (Session::has('text_direction') && Session::get('text_direction') == 'rtl')
    <!-- RTL CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}?v={{ $setting?->version }}">
@endif

{{-- Dynamic root colors --}}
<style>
    :root {
        --tg-theme-primary: #1d4ed8;
        --tg-theme-secondary: {{ $setting->secondary_color }};
        --tg-common-color-blue: {{ $setting->common_color_one }};
        --tg-common-color-blue-2: {{ $setting->common_color_two }};
        --tg-common-color-dark: {{ $setting->common_color_three }};
        --tg-common-color-black: {{ $setting->common_color_four }};
        --tg-common-color-dark-2: {{ $setting->common_color_five }};
    }
</style>

{{-- Custom Bootstrap Menu Styles --}}
<style>
    /* Custom navbar styles */
    .navbar {
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .navbar-brand img {
        max-height: 40px;
        width: auto;
    }
    
    /* Custom search form */
    .navbar .input-group {
        max-width: 500px;
    }
    
    .navbar .form-select {
        border-right: none;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    
    .navbar .form-control {
        border-left: none;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    .navbar .btn-primary {
        background-color: #1d4ed8;
        border-color: #1d4ed8;
    }
    
    .navbar .btn-primary:hover {
        background-color: #1e40af;
        border-color: #1e3a8a;
        color: white;
    }
    
    /* Custom dropdown styles */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        border-radius: 8px;
        margin-top: 5px;
    }
    
    .dropdown-item {
        padding: 8px 20px;
        transition: all 0.3s ease;
    }
    
    .dropdown-item:hover {
        background-color: #1d4ed8;
        color: white;
        transform: translateX(5px);
    }
    
    /* Custom nav links */
    .navbar-nav .nav-link {
        font-weight: 500;
        padding: 8px 16px !important;
        transition: all 0.3s ease;
        border-radius: 6px;
        margin: 0 2px;
    }
    
    .navbar-nav .nav-link:hover {
        background-color: #1d4ed8;
        color: white !important;
    }
    
    /* Cart badge */
    .position-relative .badge {
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 10px;
    }
    
    /* User dropdown */
    .navbar-nav .dropdown-menu-end {
        right: 0;
        left: auto;
    }
    
    /* Mobile menu improvements */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 10px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }
        
        .navbar-nav .nav-link {
            padding: 12px 16px !important;
            border-bottom: 1px solid #eee;
        }
        
        .navbar-nav .nav-link:last-child {
            border-bottom: none;
        }
    }
    
    /* Top bar improvements */
    .bg-dark {
        background-color: var(--tg-common-color-black) !important;
    }
    
    .bg-dark .text-white {
        color: white !important;
    }
    
    .bg-dark a {
        color: white !important;
        text-decoration: none;
    }
    
    .bg-dark a:hover {
        color: var(--tg-theme-secondary) !important;
    }
    
    /* Form select improvements */
    .form-select-sm {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }
    
    /* Social icons */
    .bg-dark img {
        transition: transform 0.3s ease;
    }
    
    .bg-dark img:hover {
        transform: scale(1.2);
    }
</style>
