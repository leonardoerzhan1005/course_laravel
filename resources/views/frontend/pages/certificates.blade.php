@extends('frontend.layouts.master')

@section('meta_title', __('Сертификаттар'))
@section('meta_description', __('Біздің институттан алған сертификаттарыңызды тексеріңіз және жүктеп алыңыз'))

@section('contents')
<!-- breadcrumb-area -->
<x-frontend.breadcrumb :title="__('Сертификаттар')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('Сертификаттар')]]" />
<!-- breadcrumb-area-end -->

<!-- Certificates Section -->
<section class="certificates-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header text-center mb-5">
                    <h1 class="display-4 fw-bold text-primary mb-3">{{ __('Сертификаттар') }}</h1>
                    <p class="lead text-muted">{{ __('Біздің институттан алған сертификаттарыңызды тексеріңіз және жүктеп алыңыз') }}</p>
                </div>

                <!-- Search Section -->
                <div class="search-section mb-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="search-card">
                                <h3 class="text-center mb-4">{{ __('Сертификатты іздеу') }}</h3>
                                <form id="certificateSearchForm" class="search-form">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="certificateNumber" class="form-label">{{ __('Сертификат нөмірі') }}</label>
                                                <input type="text" class="form-control" id="certificateNumber" name="certificate_number" 
                                                       placeholder="CERT-2025-001234">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fullName" class="form-label">{{ __('Аты-жөні') }}</label>
                                                <input type="text" class="form-control" id="fullName" name="full_name" 
                                                       placeholder="Әлібек Серіков">
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="fas fa-search me-2"></i>{{ __('Іздеу') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="search-examples mt-3">
                                    <small class="text-muted">{{ __('Мысалы') }}: CERT-2025-001234, Әлібек Серіков</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Results Section -->
                <div class="search-results-section" id="searchResults" style="display: none;">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h3 class="text-center mb-4">{{ __('Іздеу нәтижелері') }}</h3>
                            <div class="certificate-card">
                                <div class="certificate-header">
                                    <div class="certificate-icon">
                                        <i class="fas fa-certificate fa-2x text-primary"></i>
                                    </div>
                                    <div class="certificate-info">
                                        <h4 class="certificate-title">{{ __('Біліктілікті арттыру сертификаты') }}</h4>
                                        <h5 class="certificate-holder">{{ __('Әлібек Серіков') }}</h5>
                                        <p class="certificate-course">{{ __('Педагогтердің цифрлық құзыреттілігін дамыту') }}</p>
                                    </div>
                                </div>
                                <div class="certificate-details">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-item">
                                                <span class="detail-label">{{ __('Сертификат №') }}:</span>
                                                <span class="detail-value">CERT-2025-001234</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item">
                                                <span class="detail-label">{{ __('Берілген күні') }}:</span>
                                                <span class="detail-value">15.03.2025</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item">
                                                <span class="detail-label">{{ __('Жарамдылық мерзімі') }}:</span>
                                                <span class="detail-value">5 жыл</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-item">
                                                <span class="detail-label">{{ __('Статус') }}:</span>
                                                <span class="badge bg-success">{{ __('Жарамды') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="certificate-actions mt-4">
                                        <a href="#" class="btn btn-primary me-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="fas fa-eye me-2"></i>{{ __('Көру') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About Certificates Section -->
                <div class="about-certificates-section mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="about-card">
                                <h3 class="text-center mb-4">{{ __('Сертификат туралы') }}</h3>
                                <div class="about-content">
                                    <p class="mb-3">{{ __('Біздің институт ұсынатын сертификаттар мемлекеттік үлгідегі құжат болып табылады және біліктілікті растайды.') }}</p>
                                    <p class="mb-3">{{ __('Сертификат алу үшін курс бағдарламасын толық аяқтап, қорытынды тестілеуден өту қажет.') }}</p>
                                    <p class="mb-0">{{ __('Сертификаттың түпнұсқалығын осы бетте тексеруге болады. Сертификат нөмірі немесе аты-жөніңізді енгізіңіз.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-center mb-5">{{ __('Жиі қойылатын сұрақтар') }}</h2>
                
                <div class="accordion" id="certificateFAQ">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                {{ __('Сертификатты қайдан алуға болады?') }}
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#certificateFAQ">
                            <div class="accordion-body">
                                {{ __('Сертификаттың түпнұсқасын курс аяқталғаннан кейін 10 жұмыс күні ішінде институт кеңсесінен алуға болады. Сондай-ақ, электрондық нұсқасын осы бетте жүктеп алуға болады.') }}
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                {{ __('Сертификаттың жарамдылық мерзімі қандай?') }}
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#certificateFAQ">
                            <div class="accordion-body">
                                {{ __('Сертификаттың жарамдылық мерзімі курс түріне байланысты. Біліктілікті арттыру курстары сертификаттарының жарамдылық мерзімі әдетте 3-5 жыл, ал тілдік курстар сертификаттарының жарамдылық мерзімі шектеусіз болады.') }}
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                {{ __('Сертификатты жоғалтып алсам не істеуім керек?') }}
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#certificateFAQ">
                            <div class="accordion-body">
                                {{ __('Сертификатты жоғалтқан жағдайда, институт кеңсесіне жазбаша өтініш беру қажет. Сертификаттың көшірмесін жасау үшін төлем алынады.') }}
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                {{ __('Сертификаттың түпнұсқалығын қалай тексеруге болады?') }}
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#certificateFAQ">
                            <div class="accordion-body">
                                {{ __('Сертификаттың түпнұсқалығын осы бетте сертификат нөмірін немесе аты-жөніңізді енгізу арқылы тексеруге болады. Сондай-ақ, институт кеңсесіне хабарласуға болады.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="fw-bold mb-4">{{ __('Басқа сұрақтар бойынша бізге хабарласыңыз') }}</h3>
                <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-envelope me-2"></i>{{ __('Байланысқа шығу') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
<style>
.certificates-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.search-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.search-form .form-control {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.search-form .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.certificate-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
    margin-top: 2rem;
}

.certificate-header {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f8f9fa;
}

.certificate-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 1.5rem;
}

.certificate-title {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.certificate-holder {
    color: #667eea;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.certificate-course {
    color: #6c757d;
    margin-bottom: 0;
    font-size: 0.9rem;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.detail-label {
    font-weight: 500;
    color: #6c757d;
}

.detail-value {
    font-weight: 600;
    color: #2c3e50;
}

.certificate-actions {
    text-align: center;
}

.about-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.about-content p {
    color: #6c757d;
    line-height: 1.6;
}

.accordion-item {
    border: none;
    margin-bottom: 1rem;
    border-radius: 10px !important;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.accordion-button {
    background: white;
    border: none;
    font-weight: 500;
    color: #2c3e50;
    padding: 1.25rem 1.5rem;
}

.accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: none;
    border: none;
}

.accordion-body {
    background: #f8f9fa;
    color: #6c757d;
    line-height: 1.6;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.btn-outline-primary {
    border: 2px solid #667eea;
    color: #667eea;
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
}

.badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.75rem;
    border-radius: 15px;
}

.search-examples {
    text-align: center;
    font-style: italic;
}
</style>
@endpush

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('certificateSearchForm');
    const searchResults = document.getElementById('searchResults');

    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Показать результаты поиска (для демонстрации)
        searchResults.style.display = 'block';
        
        // Прокрутить к результатам
        searchResults.scrollIntoView({ behavior: 'smooth' });
    });
});
</script>
@endpush