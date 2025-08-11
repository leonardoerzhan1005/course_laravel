@extends('frontend.layouts.master')

@section('meta_title', $seo_setting['home_page']['seo_title'] ?? '')
@section('meta_description', $seo_setting['home_page']['seo_description'] ?? '')
@section('meta_keywords', '')

@section('contents')
    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
        <div class="hero-bg" style="background: linear-gradient(135deg, #1F3A8A 0%, #2E5AA0 100%);"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6 text-white">
                    <!-- Логотипы -->
                    <div class="hero-logos mb-4">
                        <div class="d-flex align-items-center gap-4">
                            <img src="{{ asset('frontend/img/farabi_logo.png') }}" alt="FARABI Logo" class="hero-logo farabi-logo">
                            <img src="{{ asset('frontend/img/ipk_logo.png') }}" alt="IPK Logo" class="hero-logo ipk-logo">
                        </div>
                    </div>
                    
                    <h1 class="display-4 fw-bold mb-4 text-white">{{ __('home.hero_title') }}</h1>
                    <p class="lead mb-5 text-white">{{ __('home.hero_subtitle') }}</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('application-form') }}" class="btn btn-light btn-lg px-5 py-3 fw-semibold text-dark">
                            {{ __('home.apply_button') }}
                        </a>
                        <a href="{{ route('services') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-semibold text-white border-white">
                            {{ __('home.services_title') }}
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image-wrapper">
                        <img src="{{ asset('frontend/img/university-building.png') }}" 
                             alt="Әл-Фараби атындағы ҚазҰУ - Біліктілікті арттыру институты" 
                             class="img-fluid hero-image">
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-shape">
            <svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card text-center p-4 rounded-4 shadow-sm border-0 bg-white">
                        <div class="stat-icon mb-3">
                            <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold text-primary mb-2">40+</h2>
                        <p class="h6 text-muted mb-0">{{ __('home.stats_directions') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card text-center p-4 rounded-4 shadow-sm border-0 bg-white">
                        <div class="stat-icon mb-3">
                            <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-certificate fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold text-primary mb-2">368+</h2>
                        <p class="h6 text-muted mb-0">{{ __('home.stats_specializations') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card text-center p-4 rounded-4 shadow-sm border-0 bg-white">
                        <div class="stat-icon mb-3">
                            <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-clock fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold text-primary mb-2">23</h2>
                        <p class="h6 text-muted mb-0">{{ __('home.stats_years') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card text-center p-4 rounded-4 shadow-sm border-0 bg-white">
                        <div class="stat-icon mb-3">
                            <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold text-primary mb-2">15000+</h2>
                        <p class="h6 text-muted mb-0">{{ __('home.stats_graduates') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-4 fw-bold mb-3 text-primary">{{ __('home.services_title') }}</h2>
                    <p class="lead text-muted mx-auto" style="max-width: 600px;">{{ __('home.services_subtitle') }}</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 p-4 rounded-4">
                        <div class="service-icon mb-4">
                            <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-university fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="h5 mb-3 fw-bold">{{ __('home.service_university_teachers') }}</h4>
                        <p class="mb-0">{{ __('home.service_university_teachers_desc') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 p-4 rounded-4">
                        <div class="service-icon mb-4">
                            <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-chalkboard-teacher fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="h5 mb-3 fw-bold">{{ __('home.service_school_teachers') }}</h4>
                        <p class="mb-0">{{ __('home.service_school_teachers_desc') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 p-4 rounded-4">
                        <div class="service-icon mb-4">
                            <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-heart fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="h5 mb-3 fw-bold">{{ __('home.service_silver_university') }}</h4>
                        <p class="mb-0">{{ __('home.service_silver_university_desc') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 p-4 rounded-4">
                        <div class="service-icon mb-4">
                            <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-user-graduate fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="h5 mb-3 fw-bold">{{ __('home.service_pedagogical_retraining') }}</h4>
                        <p class="mb-0">{{ __('home.service_pedagogical_retraining_desc') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 p-4 rounded-4">
                        <div class="service-icon mb-4">
                            <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-briefcase fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="h5 mb-3 fw-bold">{{ __('home.service_professional_retraining') }}</h4>
                        <p class="mb-0">{{ __('home.service_professional_retraining_desc') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 p-4 rounded-4">
                        <div class="service-icon mb-4">
                            <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-globe fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="h5 mb-3 fw-bold">{{ __('home.service_language_courses') }}</h4>
                        <p class="mb-0">{{ __('home.service_language_courses_desc') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 p-4 rounded-4">
                        <div class="service-icon mb-4">
                            <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-chart-line fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="h5 mb-3 fw-bold">{{ __('home.service_management_courses') }}</h4>
                        <p class="mb-0">{{ __('home.service_management_courses_desc') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 p-4 rounded-4">
                        <div class="service-icon mb-4">
                            <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-robot fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="h5 mb-3 fw-bold">{{ __('home.service_ai_tech') }}</h4>
                        <p class="mb-0">{{ __('home.service_ai_tech_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-4 fw-bold mb-3 text-primary">{{ __('home.testimonials_title') }}</h2>
                    <p class="lead text-muted mx-auto" style="max-width: 600px;">{{ __('home.testimonials_subtitle') }}</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="testimonial-card h-100 p-4 rounded-4 shadow border-0 bg-white">
                        <div class="testimonial-quote mb-4">
                            <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                        </div>
                        <p class="mb-4 fs-5">{{ __('home.testimonial_1_text') }}</p>
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <span class="text-white fw-bold fs-4">А</span>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">{{ __('home.testimonial_1_author') }}</h6>
                                <small class="text-muted">{{ __('home.testimonial_1_position') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testimonial-card h-100 p-4 rounded-4 shadow border-0 bg-white">
                        <div class="testimonial-quote mb-4">
                            <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                        </div>
                        <p class="mb-4 fs-5">{{ __('home.testimonial_2_text') }}</p>
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <span class="text-white fw-bold fs-4">Е</span>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">{{ __('home.testimonial_2_author') }}</h6>
                                <small class="text-muted">{{ __('home.testimonial_2_position') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testimonial-card h-100 p-4 rounded-4 shadow border-0 bg-white">
                        <div class="testimonial-quote mb-4">
                            <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                        </div>
                        <p class="mb-4 fs-5">{{ __('home.testimonial_3_text') }}</p>
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <span class="text-white fw-bold fs-4">К</span>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">{{ __('home.testimonial_3_author') }}</h6>
                                <small class="text-muted">{{ __('home.testimonial_3_position') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="#" class="btn btn-primary btn-lg px-5 py-3 fw-semibold rounded-pill shadow">{{ __('home.leave_review') }}</a>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h2 class="display-4 fw-bold mb-2 text-primary">{{ __('home.news_title') }}</h2>
                        <p class="lead text-muted">{{ __('home.news_subtitle') }}</p>
                    </div>
                    <a href="{{ route('blogs') }}" class="btn btn-outline-primary btn-lg px-4 py-2 fw-semibold rounded-pill">{{ __('home.all_news') }}</a>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="news-card h-100 border-0 rounded-4 overflow-hidden shadow-sm bg-white hover-lift">
                        <div class="news-image bg-primary bg-opacity-10" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar-alt fa-3x text-primary opacity-50"></i>
                        </div>
                        <div class="p-4">
                            <small class="text-muted fw-semibold">{{ __('home.news_1_date') }}</small>
                            <h5 class="mt-2 mb-3 fw-bold">{{ __('home.news_1_title') }}</h5>
                            <p class="text-muted mb-3">{{ __('home.news_1_desc') }}</p>
                            <a href="#" class="btn btn-link p-0 text-primary fw-semibold text-decoration-none">{{ __('home.read_more') }} <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="news-card h-100 border-0 rounded-4 overflow-hidden shadow-sm bg-white hover-lift">
                        <div class="news-image bg-primary bg-opacity-10" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-handshake fa-3x text-primary opacity-50"></i>
                        </div>
                        <div class="p-4">
                            <small class="text-muted fw-semibold">{{ __('home.news_2_date') }}</small>
                            <h5 class="mt-2 mb-3 fw-bold">{{ __('home.news_2_title') }}</h5>
                            <p class="text-muted mb-3">{{ __('home.news_2_desc') }}</p>
                            <a href="#" class="btn btn-link p-0 text-primary fw-semibold text-decoration-none">{{ __('home.read_more') }} <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="news-card h-100 border-0 rounded-4 overflow-hidden shadow-sm bg-white hover-lift">
                        <div class="news-image bg-primary bg-opacity-10" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-laptop-code fa-3x text-primary opacity-50"></i>
                        </div>
                        <div class="p-4">
                            <small class="text-muted fw-semibold">{{ __('home.news_3_date') }}</small>
                            <h5 class="mt-2 mb-3 fw-bold">{{ __('home.news_3_title') }}</h5>
                            <p class="text-muted mb-3">{{ __('home.news_3_desc') }}</p>
                            <a href="#" class="btn btn-link p-0 text-primary fw-semibold text-decoration-none">{{ __('home.read_more') }} <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- History & Stats Section -->
    <section class="history-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 class="display-4 fw-bold mb-4 text-primary">{{ __('home.history_title') }}</h2>
                    <p class="lead text-muted mb-4">{{ __('home.history_text') }}</p>
                    
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3 bg-primary bg-opacity-10">
                                <h4 class="fw-bold text-primary mb-1">50+</h4>
                                <p class="mb-0 text-muted fw-semibold">{{ __('home.teachers_count') }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3 bg-primary bg-opacity-10">
                                <h4 class="fw-bold text-primary mb-1">100%</h4>
                                <p class="mb-0 text-muted fw-semibold">{{ __('home.certification') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="license-card p-5 rounded-4 bg-gradient text-white text-center" style="background: linear-gradient(135deg, #1F3A8A 0%, #2E5AA0 100%);">
                        <div class="mb-4">
                            <i class="fas fa-certificate fa-4x text-white opacity-75"></i>
                        </div>
                        <h3 class="fw-bold mb-3">{{ __('home.license') }}</h3>
                        <p class="mb-0 opacity-90">{{ __('home.license_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-4 fw-bold mb-5 text-primary">{{ __('home.contact_title') }}</h2>
                    
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="contact-item p-4 rounded-4 bg-white shadow-sm">
                                <div class="contact-icon mb-3">
                                    <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                                    </div>
                                </div>
                                <h5 class="fw-bold mb-2">{{ __('home.address') }}</h5>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="contact-item p-4 rounded-4 bg-white shadow-sm">
                                <div class="contact-icon mb-3">
                                    <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        <i class="fas fa-phone fa-2x text-primary"></i>
                                    </div>
                                </div>
                                <h5 class="fw-bold mb-2">{{ __('home.phone') }}</h5>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="contact-item p-4 rounded-4 bg-white shadow-sm">
                                <div class="contact-icon mb-3">
                                    <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        <i class="fas fa-envelope fa-2x text-primary"></i>
                                    </div>
                                </div>
                                <h5 class="fw-bold mb-2">{{ __('home.email') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
:root {
    --primary-color: #1F3A8A;
    --primary-light: #2E5AA0;
    --primary-opacity-10: rgba(31, 58, 138, 0.1);
    --primary-opacity-25: rgba(31, 58, 138, 0.25);
    --primary-opacity-50: rgba(31, 58, 138, 0.5);
    --primary-opacity-75: rgba(31, 58, 138, 0.75);
}

.hero-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    color: white;
    position: relative;
    overflow: hidden;
    padding: 80px 0;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.hero-section .container {
    position: relative;
    z-index: 2;
}

.min-vh-75 {
    min-height: 75vh;
}

/* Стили для логотипов */
.hero-logos {
    margin-bottom: 2rem;
}

.hero-logo {
    max-height: 80px;
    width: auto;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
    padding: 10px;
    border-radius: 10px;
}

.hero-logo:hover {
    transform: scale(1.05);
    background: rgba(255, 255, 255, 0.2);
}

.farabi-logo {
    max-height: 90px;
}

.ipk-logo {
    max-height: 70px;
}

/* Улучшенная видимость текста */
.hero-section h1 {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.hero-section .lead {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    font-weight: 500;
}

/* Улучшенные кнопки */
.hero-section .btn {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.hero-section .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.hero-section .btn-light {
    background-color: #ffffff !important;
    border-color: #ffffff !important;
    color: #1F3A8A !important;
    font-weight: 600;
}

.hero-section .btn-outline-light {
    background-color: transparent !important;
    border-color: #ffffff !important;
    color: #ffffff !important;
    font-weight: 600;
}

.hero-section .btn-outline-light:hover {
    background-color: #ffffff !important;
    color: #1F3A8A !important;
}

.hero-image-wrapper {
    position: relative;
}

.hero-image {
    max-width: 100%;
    height: auto;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.hero-shape {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    line-height: 0;
    z-index: 1;
}

.hero-shape svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: auto;
}

/* Стили для карточек услуг */
.service-card {
    background-color: var(--primary-color) !important;
    color: white !important;
    border: 2px solid var(--primary-color) !important;
    box-shadow: 0 4px 15px rgba(31, 58, 138, 0.2);
}

.service-card .service-icon .icon-wrapper {
    background-color: rgba(255, 255, 255, 0.2) !important;
}

.service-card .service-icon .icon-wrapper i {
    color: white !important;
}

.service-card h4 {
    color: white !important;
}

.service-card p {
    color: white !important;
}

.service-card:hover {
    background-color: white !important;
    color: var(--primary-color) !important;
    border: 2px solid var(--primary-color) !important;
    box-shadow: 0 8px 25px rgba(31, 58, 138, 0.3);
}

.service-card:hover .service-icon .icon-wrapper {
    background-color: var(--primary-color) !important;
}

.service-card:hover .service-icon .icon-wrapper i {
    color: white !important;
}

.service-card:hover h4 {
    color: var(--primary-color) !important;
}

.service-card:hover p {
    color: #666 !important;
}

/* Стили для карточек отзывов */
.testimonial-card {
    background-color: white !important;
    border: 2px solid var(--primary-color) !important;
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(31, 58, 138, 0.2);
}

/* Стили для новостных карточек */
.news-card {
    background-color: white !important;
    border: 2px solid var(--primary-color) !important;
    transition: all 0.3s ease;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(31, 58, 138, 0.2);
}

/* Стили для контактных элементов */
.contact-item {
    background-color: white !important;
    border: 2px solid var(--primary-color) !important;
    transition: all 0.3s ease;
}

.contact-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(31, 58, 138, 0.2);
}

.rounded-4 {
    border-radius: 1rem !important;
}

.rounded-pill {
    border-radius: 50rem !important;
}

.bg-gradient {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
}

.opacity-25 {
    opacity: 0.25 !important;
}

.opacity-50 {
    opacity: 0.5 !important;
}

.opacity-75 {
    opacity: 0.75 !important;
}

.opacity-90 {
    opacity: 0.9 !important;
}

.text-primary {
    color: var(--primary-color) !important;
}

.bg-primary {
    background-color: var(--primary-color) !important;
}

.bg-primary.bg-opacity-10 {
    background-color: var(--primary-opacity-10) !important;
}

.btn-primary {
    background-color: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}

.btn-primary:hover {
    background-color: var(--primary-light) !important;
    border-color: var(--primary-light) !important;
}

.btn-outline-primary {
    color: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}

.btn-outline-primary:hover {
    background-color: var(--primary-color) !important;
    color: white !important;
}

@media (max-width: 768px) {
    .hero-section .row {
        text-align: center;
    }
    
    .hero-section {
        padding: 60px 0;
    }
    
    .min-vh-75 {
        min-height: 60vh;
    }
    
    .hero-section h1 {
        font-size: 2.5rem;
    }
    
    .hero-section .lead {
        font-size: 1.1rem;
    }
    
    .hero-logos {
        justify-content: center;
    }
    
    .hero-logo {
        max-height: 60px;
    }
    
    .farabi-logo {
        max-height: 70px;
    }
    
    .ipk-logo {
        max-height: 55px;
    }
}

@media (max-width: 576px) {
    .hero-section {
        padding: 40px 0;
    }
    
    .hero-section h1 {
        font-size: 2rem;
    }
    
    .hero-section .lead {
        font-size: 1rem;
    }
    
    .min-vh-75 {
        min-height: 50vh;
    }
    
    .hero-logos {
        flex-direction: column;
        gap: 1rem !important;
    }
    
    .hero-logo {
        max-height: 50px;
    }
    
    .farabi-logo {
        max-height: 60px;
    }
    
    .ipk-logo {
        max-height: 45px;
    }
}
</style>



