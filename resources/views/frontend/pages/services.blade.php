@extends('frontend.layouts.master')

@section('meta_title', __('Біздің қызметтер'))
@section('meta_description', __('Біліктілікті арттыру және қосымша білім беру институты заманауи талаптарға сай білім беру бағдарламаларын ұсынады'))

@section('contents')
<div class="services-page-content">
    <!-- Hero Section -->
    <section class="services-hero py-5">
        <div class="services-page-container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">{{ __('Біздің қызметтер') }}</h1>
                    <p class="lead mb-4">{{ __('Біліктілікті арттыру және қосымша білім беру институты заманауи талаптарға сай білім беру бағдарламаларын ұсынады') }}</p>
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
                        <h3>{{ __('ЖОО оқытушыларына арналған курстар') }}</h3>
                        <p>{{ __('Жоғары оқу орындарының оқытушыларына арналған біліктілікті арттыру курстары. Заманауи педагогикалық технологиялар мен инновациялық оқыту әдістерін меңгеру.') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('Курсқа жазылу') }}</button>
                    </div>
                    <div class="service-content">
                        
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('Заманауи педагогикалық технологиялар') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Цифрлық білім беру платформалары') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                       
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('Ғылыми-зерттеу жұмыстары әдістемесі') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Студенттермен жұмыс істеу дағдылары') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Мектеп және колледж мұғалімдеріне -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3>{{ __('Мектеп және колледж мұғалімдеріне') }}</h3>
                        <p>{{ __('Орта білім беру мекемелерінің педагогтарына арналған бағдарламалар. Қазіргі заман талаптарына сай оқыту әдістерін дамыту.') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('Курсқа жазылу') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('Курс мазмұны') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('Жаңа оқыту әдістемелері') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Оқушылардың мотивациясын арттыру') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('Қосымша мазмұн') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('Сыни ойлауды дамыту') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Инклюзивті білім беру') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Күміс университеті -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>{{ __('Күміс университеті') }}</h3>
                        <p>{{ __('Зейнеткерлер мен аға буын өкілдеріне арналған білім беру бағдарламалары. Өмір бойы үйренуді қамтамасыз ету және белсенді әлеуметтік өмірге қатысу.') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('Курсқа жазылу') }}</button>
                    </div>
                    <div class="service-content">
                        
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('Компьютерлік сауаттылық') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Денсаулық сақтау') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('Қолөнер дағдылары') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Әлеуметтік бейімделу') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Педагогикалық қайта даярлау курстары -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3>{{ __('Педагогикалық қайта даярлау курстары') }}</h3>
                        <p>{{ __('Педагогикалық мамандық бойынша қайта даярлау және біліктілікті арттыру. Заманауи педагогикалық әдістемелер мен технологияларды үйрену.') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('Курсқа жазылу') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('Курс мазмұны') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('Педагогикалық психология') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Оқыту әдістемесі') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('Қосымша мазмұн') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('Білім беру менеджменті') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Бағалау жүйелері') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Кәсіби қайта даярлау -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3>{{ __('Кәсіби қайта даярлау') }}</h3>
                        <p>{{ __('Басқа мамандықтарға қайта даярлау және жаңа дағдыларды игеру бағдарламалары. Еңбек нарығының қажеттіліктеріне сәйкес құзыреттіліктерді дамыту.') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('Курсқа жазылу') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('Курс мазмұны') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('Жаңа мамандықты игеру') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Практикалық дағдылар') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('Қосымша мазмұн') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('Еңбек нарығына бейімделу') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Кәсіби сертификация') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Тілдік курстар -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <h3>{{ __('Тілдік курстар') }}</h3>
                        <p>{{ __('Шет тілдерін және қазақ тілін меңгеруге арналған курстар. Халықаралық стандарттарға сәйкес тілдік дағдыларды дамыту.') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('Курсқа жазылу') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('Курс мазмұны') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('Ағылшын тілі (A1-C2)') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Қазақ тілі деңгейлері') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('Қосымша мазмұн') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('Түрік, қытай тілдері') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Халықаралық сертификаттарға дайындық') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Басқару және менеджмент курстары -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>{{ __('Басқару және менеджмент курстары') }}</h3>
                        <p>{{ __('Басқару дағдыларын дамытуға бағытталған курстар. Заманауи менеджмент әдістері мен көшбасшылық дағдыларын үйрену.') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('Курсқа жазылу') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('Курс мазмұны') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('Стратегиялық жоспарлау') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Команда басқару') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('Қосымша мазмұн') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('Жобалық менеджмент') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Көшбасшылық дағдылар') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Жасанды интеллект және цифрлық технологиялар -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h3>{{ __('Жасанды интеллект және цифрлық технологиялар') }}</h3>
                        <p>{{ __('AI, машиналық оқыту және заманауи цифрлық технологиялар бойынша курстар. Болашақтың технологияларын меңгеру.') }}</p>
                        <button class="services-btn services-btn-primary">{{ __('Курсқа жазылу') }}</button>
                    </div>
                    <div class="service-content">
                        <h6>{{ __('Курс мазмұны') }}:</h6>
                        <ul class="course-list">
                            <li><i class="fas fa-check"></i><span>{{ __('Жасанды интеллект негіздері') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Машиналық оқыту') }}</span></li>
                        </ul>
                    </div>
                    <div class="service-content-right">
                        <h6>{{ __('Қосымша мазмұн') }}:</h6>
                        <ul class="course-list-right">
                            <li><i class="fas fa-check"></i><span>{{ __('Деректерді талдау') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('Цифрлық трансформация') }}</span></li>
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
                    <h2 class="fw-bold mb-4">{{ __('Қосымша ақпарат алғыңыз келе ме?') }}</h2>
                    <p class="lead mb-4">{{ __('Біздің курстар, бағдарламалар мен қызметтер туралы толық ақпарат алу үшін бізге хабарласыңыз.') }}</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('contact.index') }}" class="services-btn services-btn-outline-primary services-btn-lg services-w-100">
                                <i class="fas fa-phone me-2"></i>{{ __('Байланысқа шығу') }}
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('application-form') }}" class="services-btn services-btn-primary services-btn-lg services-w-100">
                                <i class="fas fa-file-alt me-2"></i>{{ __('Өтініш қалдыру') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

