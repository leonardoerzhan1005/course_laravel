<script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/proper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.odometer.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.appear.js') }}"></script>
<script src="{{ asset('frontend/js/tween-max.min.js') }}"></script>
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.marquee.min.js') }}"></script>
@if ($setting?->cursor_dot_status == 'active')
    <script src="{{ asset('frontend/js/tg-cursor.min.js') }}"></script>
@endif
<script src="{{ asset('frontend/js/svg-inject.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.circleType.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.lettering.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('frontend/js/plyr.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/js/aos.js') }}"></script>
<script src="{{ asset('frontend/js/vivus.min.js') }}"></script>
<script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('frontend/js/sweetalert.js') }}"></script>
<script src="{{ asset('frontend/js/default/frontend.js') }}?v={{ $setting?->version }}"></script>
<script src="{{ asset('frontend/js/default/cart.js') }}?v={{ $setting?->version }}"></script>
<script src="{{ asset('global/nice-select/jquery.nice-select.min.js') }}"></script>
<!-- File Manager js-->
<script src="{{ url('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>


<script src="{{ asset('frontend/js/main.js') }}?v={{ $setting?->version }}"></script>

<script>
    $('.file-manager').filemanager('file', {
        prefix: '{{ url('/frontend-filemanager') }}'
    });
    $('.file-manager-image').filemanager('image', {
        prefix: '{{ url('/frontend-filemanager') }}'
    });

    SVGInject(document.querySelectorAll("img.injectable"));
</script>

<!-- dynamic Toastr Notification -->
<script>
    "use strict";
    toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    toastr.options.positionClass = 'toast-bottom-right';

    @session('messege')
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':
            toastr.info("{{ $value }}");
            break;
        case 'success':
            toastr.success("{{ $value }}");
            break;
        case 'warning':
            toastr.warning("{{ $value }}");
            break;
        case 'error':
            toastr.error("{{ $value }}");
            break;
    }
    @endsession

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        orientation: "bottom auto"
    });
</script>


<!-- Toastr -->
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}', null, {
                timeOut: 10000
            });
        </script>
    @endforeach
@endif


<!-- Google reCAPTCHA -->
@if (Cache::get('setting')->recaptcha_status === 'active')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif

<!-- tawk -->
@if ($setting->tawk_status == 'active')
    <script type="text/javascript">
        "use strict";
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = '{{ $setting->tawk_chat_link }}';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
@endif

<!-- Cookie Consent -->
@if ($setting->cookie_status == 'active')
    <script src="{{ asset('frontend/js/cookieconsent.min.js') }}"></script>

    <script>
        "use strict";
        window.addEventListener("load", function() {
            window.wpcc.init({
                "border": "{{ $setting->border }}",
                "corners": "{{ $setting->corners }}",
                "colors": {
                    "popup": {
                        "background": "{{ $setting->background_color }}",
                        "text": "{{ $setting->text_color }} !important",
                        "border": "{{ $setting->border_color }}"
                    },
                    "button": {
                        "background": "{{ $setting->btn_bg_color }}",
                        "text": "{{ $setting->btn_text_color }}"
                    }
                },
                "content": {
                    "href": "{{ url($setting->link) }}",
                    "message": "{{ $setting->message }}",
                    "link": "{{ $setting->link_text }}",
                    "button": "{{ $setting->btn_text }}"
                }
            })
        });
    </script>
@endif

<script>
    if ($(".marquee_mode").length) {
        $('.marquee_mode').marquee({
            speed: 20,
            gap: 35,
            delayBeforeStart: 0,
            direction: "{{ Session::has('text_direction') && Session::get('text_direction') == 'rtl' ? 'right' : 'left' }}",
            duplicated: true,
            pauseOnHover: true,
            startVisible: true,
        });
    }
</script>

<script>
    $(document).on("click", '.wpcc-btn', function() {
        $('.wpcc-container').fadeOut(1000);
    });
</script>

{{-- Custom Bootstrap Menu JavaScript --}}
<script>
    $(document).ready(function() {
        // Auto-submit language and currency forms
        $('#setLanguageHeader select').on('change', function() {
            $(this).closest('form').submit();
        });
        
        $('.change-currency').on('change', function() {
            $(this).closest('form').submit();
        });
        
        // Mobile menu improvements
        $('.navbar-toggler').on('click', function() {
            $('.navbar-collapse').slideToggle(300);
        });
        
        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.navbar').length) {
                $('.navbar-collapse').collapse('hide');
            }
        });
        
        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800);
            }
        });
        
        // Add active class to current nav item
        var currentPath = window.location.pathname;
        $('.navbar-nav .nav-link').each(function() {
            var linkPath = $(this).attr('href');
            if (linkPath && currentPath.includes(linkPath) && linkPath !== '/') {
                $(this).addClass('active');
            }
        });
        
        // Dropdown hover effect (desktop only)
        if (window.innerWidth > 991) {
            $('.dropdown').hover(
                function() {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(300);
                },
                function() {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(300);
                }
            );
        }
        
        // Search form improvements
        $('.navbar .input-group').on('submit', function(e) {
            var searchInput = $(this).find('input[name="search"]');
            var categorySelect = $(this).find('select[name="main_category"]');
            
            if (!searchInput.val().trim() && categorySelect.val() === 'Categories') {
                e.preventDefault();
                toastr.warning('Please enter a search term or select a category');
                return false;
            }
        });
        
        // Logout functionality
        $('.logout-btn').on('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                $('#logout-form').submit();
            }
        });
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Navbar scroll effect
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 50) {
                $('.navbar').addClass('navbar-scrolled');
            } else {
                $('.navbar').removeClass('navbar-scrolled');
            }
        });
    });
</script>

<style>
    /* Navbar scroll effect */
    .navbar-scrolled {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0,0,0,0.1) !important;
    }
    
    /* Loading animation for forms */
    .form-submitting {
        opacity: 0.7;
        pointer-events: none;
    }
    
    .form-submitting::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid var(--tg-theme-primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
