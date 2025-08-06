@extends('frontend.layouts.master')

@section('meta_title', __('Біздің қызметтер'))
@section('meta_description', __('Біліктілікті арттыру және қосымша білім беру институты заманауи талаптарға сай білім беру бағдарламаларын ұсынады'))

@section('contents')
<!-- breadcrumb-area -->
<x-frontend.breadcrumb :title="__('Біздің қызметтер')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('Біздің қызметтер')]]" />
<!-- breadcrumb-area-end -->

<!-- Hero Section -->
<section class="hero-section bg-gradient-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">{{ __('Біздің қызметтер') }}</h1>
                <p class="lead mb-4">{{ __('Біліктілікті арттыру және қосымша білім беру институты заманауи талаптарға сай білім беру бағдарламаларын ұсынады') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section py-5">
    <div class="container">
        <div class="row g-4">
            <!-- ЖОО оқытушыларына арналған курстар -->
            <div class="col-lg-6 col-md-6">
                <div class="service-card h-100 shadow-sm border-0 rounded-3 p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ __('ЖОО оқытушыларына арналған курстар') }}</h4>
                    <p class="text-muted mb-4">{{ __('Жоғары оқу орындарының оқытушыларына арналған біліктілікті арттыру курстары. Заманауи педагогикалық технологиялар мен инновациялық оқыту әдістерін меңгеру.') }}</p>
                    
                    <div class="course-content mb-4">
                        <h6 class="fw-bold mb-2">{{ __('Курс мазмұны') }}:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Заманауи педагогикалық технологиялар') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Ғылыми-зерттеу жұмыстары әдістемесі') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Цифрлық білім беру платформалары') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Студенттермен жұмыс істеу дағдылары') }}</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary w-100">{{ __('Курсқа жазылу') }}</button>
                </div>
            </div>

            <!-- Мектеп және колледж мұғалімдеріне -->
            <div class="col-lg-6 col-md-6">
                <div class="service-card h-100 shadow-sm border-0 rounded-3 p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ __('Мектеп және колледж мұғалімдеріне') }}</h4>
                    <p class="text-muted mb-4">{{ __('Орта білім беру мекемелерінің педагогтарына арналған бағдарламалар. Қазіргі заман талаптарына сай оқыту әдістерін дамыту.') }}</p>
                    
                    <div class="course-content mb-4">
                        <h6 class="fw-bold mb-2">{{ __('Курс мазмұны') }}:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Жаңа оқыту әдістемелері') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Оқушылардың мотивациясын арттыру') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Сыни ойлауды дамыту') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Инклюзивті білім беру') }}</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary w-100">{{ __('Курсқа жазылу') }}</button>
                </div>
            </div>

            <!-- Күміс университеті -->
            <div class="col-lg-6 col-md-6">
                <div class="service-card h-100 shadow-sm border-0 rounded-3 p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ __('Күміс университеті') }}</h4>
                    <p class="text-muted mb-4">{{ __('Зейнеткерлер мен аға буын өкілдеріне арналған білім беру бағдарламалары. Өмір бойы үйренуді қамтамасыз ету және белсенді әлеуметтік өмірге қатысу.') }}</p>
                    
                    <div class="course-content mb-4">
                        <h6 class="fw-bold mb-2">{{ __('Курс мазмұны') }}:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Компьютерлік сауаттылық') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Денсаулық сақтау') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Қолөнер дағдылары') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Әлеуметтік бейімделу') }}</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary w-100">{{ __('Курсқа жазылу') }}</button>
                </div>
            </div>

            <!-- Педагогикалық қайта даярлау курстары -->
            <div class="col-lg-6 col-md-6">
                <div class="service-card h-100 shadow-sm border-0 rounded-3 p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-certificate fa-2x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ __('Педагогикалық қайта даярлау курстары') }}</h4>
                    <p class="text-muted mb-4">{{ __('Педагогикалық мамандық бойынша қайта даярлау және біліктілікті арттыру. Заманауи педагогикалық әдістемелер мен технологияларды үйрену.') }}</p>
                    
                    <div class="course-content mb-4">
                        <h6 class="fw-bold mb-2">{{ __('Курс мазмұны') }}:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Педагогикалық психология') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Оқыту әдістемесі') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Білім беру менеджменті') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Бағалау жүйелері') }}</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary w-100">{{ __('Курсқа жазылу') }}</button>
                </div>
            </div>

            <!-- Кәсіби қайта даярлау -->
            <div class="col-lg-6 col-md-6">
                <div class="service-card h-100 shadow-sm border-0 rounded-3 p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-briefcase fa-2x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ __('Кәсіби қайта даярлау') }}</h4>
                    <p class="text-muted mb-4">{{ __('Басқа мамандықтарға қайта даярлау және жаңа дағдыларды игеру бағдарламалары. Еңбек нарығының қажеттіліктеріне сәйкес құзыреттіліктерді дамыту.') }}</p>
                    
                    <div class="course-content mb-4">
                        <h6 class="fw-bold mb-2">{{ __('Курс мазмұны') }}:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Жаңа мамандықты игеру') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Практикалық дағдылар') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Еңбек нарығына бейімделу') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Кәсіби сертификация') }}</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary w-100">{{ __('Курсқа жазылу') }}</button>
                </div>
            </div>

            <!-- Тілдік курстар -->
            <div class="col-lg-6 col-md-6">
                <div class="service-card h-100 shadow-sm border-0 rounded-3 p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-language fa-2x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ __('Тілдік курстар') }}</h4>
                    <p class="text-muted mb-4">{{ __('Шет тілдерін және қазақ тілін меңгеруге арналған курстар. Халықаралық стандарттарға сәйкес тілдік дағдыларды дамыту.') }}</p>
                    
                    <div class="course-content mb-4">
                        <h6 class="fw-bold mb-2">{{ __('Курс мазмұны') }}:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Ағылшын тілі (A1-C2)') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Қазақ тілі деңгейлері') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Түрік, қытай тілдері') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Халықаралық сертификаттарға дайындық') }}</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary w-100">{{ __('Курсқа жазылу') }}</button>
                </div>
            </div>

            <!-- Басқару және менеджмент курстары -->
            <div class="col-lg-6 col-md-6">
                <div class="service-card h-100 shadow-sm border-0 rounded-3 p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-chart-line fa-2x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ __('Басқару және менеджмент курстары') }}</h4>
                    <p class="text-muted mb-4">{{ __('Басқару дағдыларын дамытуға бағытталған курстар. Заманауи менеджмент әдістері мен көшбасшылық дағдыларын үйрену.') }}</p>
                    
                    <div class="course-content mb-4">
                        <h6 class="fw-bold mb-2">{{ __('Курс мазмұны') }}:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Стратегиялық жоспарлау') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Команда басқару') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Жобалық менеджмент') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Көшбасшылық дағдылар') }}</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary w-100">{{ __('Курсқа жазылу') }}</button>
                </div>
            </div>

            <!-- Жасанды интеллект және цифрлық технологиялар -->
            <div class="col-lg-6 col-md-6">
                <div class="service-card h-100 shadow-sm border-0 rounded-3 p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-robot fa-2x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ __('Жасанды интеллект және цифрлық технологиялар') }}</h4>
                    <p class="text-muted mb-4">{{ __('AI, машиналық оқыту және заманауи цифрлық технологиялар бойынша курстар. Болашақтың технологияларын меңгеру.') }}</p>
                    
                    <div class="course-content mb-4">
                        <h6 class="fw-bold mb-2">{{ __('Курс мазмұны') }}:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Жасанды интеллект негіздері') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Машиналық оқыту') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Деректерді талдау') }}</li>
                            <li><i class="fas fa-check text-success me-2"></i>{{ __('Цифрлық трансформация') }}</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary w-100">{{ __('Курсқа жазылу') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-4">{{ __('Қосымша ақпарат алғыңыз келе ме?') }}</h2>
                <p class="lead mb-4">{{ __('Біздің курстар, бағдарламалар мен қызметтер туралы толық ақпарат алу үшін бізге хабарласыңыз.') }}</p>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-primary btn-lg w-100">
                            <i class="fas fa-phone me-2"></i>{{ __('Байланысқа шығу') }}
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('application-form') }}" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-file-alt me-2"></i>{{ __('Өтініш қалдыру') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.service-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e9ecef;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.service-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.course-content ul li {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.btn {
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}

.btn-outline-primary {
    border: 2px solid #667eea;
    color: #667eea;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
}

.contact-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
</style>
@endpush