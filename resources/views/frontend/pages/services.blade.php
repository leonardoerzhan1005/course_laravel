@extends('frontend.layouts.master')

@section('meta_title', __('services.meta_title'))
@section('meta_description', __('services.meta_description'))

@section('contents')
<div class="services-page-content">
    <!-- Hero Section -->
    <section class="services-hero py-5">
        <div class="services-page-container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">{{ __('services.hero_title') }}</h1>
                    <p class="lead mb-4">{{ __('services.hero_description') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section py-5">
        <div class="services-page-container">
                        <div class="services-grid">
                <!-- ЖОО оқытушыларына арналған курстар -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3>{{ __('services.courses_for_university_teachers') }}</h3>
                        <p>{{ __('services.courses_for_university_teachers_desc') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('services.enroll_course') }}</button>
                    </div>
                    <div class="service-content">
                        
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('services.modern_pedagogical_technologies') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.digital_education_platforms') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                       
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('services.research_methodology') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.student_work_skills') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Мектеп және колледж мұғалімдеріне -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3>{{ __('services.school_college_teachers') }}</h3>
                        <p>{{ __('services.school_college_teachers_desc') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('services.enroll_course') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('services.course_content') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('services.new_teaching_methods') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.student_motivation') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('services.additional_content') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('services.critical_thinking') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.inclusive_education') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Күміс университеті -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>{{ __('services.silver_university') }}</h3>
                        <p>{{ __('services.silver_university_desc') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('services.enroll_course') }}</button>
                    </div>
                    <div class="service-content">
                        
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('services.computer_literacy') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.health_care') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('services.handicraft_skills') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.social_adaptation') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Педагогикалық қайта даярлау курстары -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3>{{ __('services.pedagogical_retraining') }}</h3>
                        <p>{{ __('services.pedagogical_retraining_desc') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('services.enroll_course') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('services.course_content') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('services.pedagogical_psychology') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.teaching_methodology') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('services.additional_content') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('services.education_management') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.assessment_systems') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Кәсіби қайта даярлау -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3>{{ __('services.professional_retraining') }}</h3>
                        <p>{{ __('services.professional_retraining_desc') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('services.enroll_course') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('services.course_content') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('services.new_specialty_mastery') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.practical_skills') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('services.additional_content') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('services.labor_market_adaptation') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.professional_certification') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Тілдік курстар -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <h3>{{ __('services.language_courses') }}</h3>
                        <p>{{ __('services.language_courses_desc') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('services.enroll_course') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('services.course_content') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('services.english_language') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.kazakh_language_levels') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('services.additional_content') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('services.turkish_chinese_languages') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.international_certificates_prep') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Басқару және менеджмент курстары -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>{{ __('services.management_management_courses') }}</h3>
                        <p>{{ __('services.management_management_courses_desc') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('services.enroll_course') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('services.course_content') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('services.strategic_planning') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.team_management') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('services.additional_content') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('services.project_management') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.leadership_skills') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Жасанды интеллект және цифрлық технологиялар -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h3>{{ __('services.ai_digital_technologies') }}</h3>
                        <p>{{ __('services.ai_digital_technologies_desc') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('services.enroll_course') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('services.course_content') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('services.ai_fundamentals') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.machine_learning') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('services.additional_content') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('services.data_analysis') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('services.digital_transformation') }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Contact Section -->
    <section class="services-contact py-5">
        <div class="services-page-container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">{{ __('services.need_more_info') }}</h2>
                    <p class="lead mb-4">{{ __('services.contact_for_info') }}</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('contact.index') }}" class="services-btn services-btn-outline-primary services-btn-lg services-w-100">
                                <i class="fas fa-phone me-2"></i>{{ __('services.contact_us') }}
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('application-form') }}" class="services-btn services-btn-primary services-btn-lg services-w-100">
                                <i class="fas fa-file-alt me-2"></i>{{ __('services.submit_application') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

