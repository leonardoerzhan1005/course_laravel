@extends('frontend.layouts.master')

@section('meta_title', __('Құжаттар'))
@section('meta_description', __('Біліктілікті арттыру және қосымша білім беру институтының нормативтік құжаттары, бұйрықтары және нұсқаулықтары'))

@section('contents')
<!-- breadcrumb-area -->
<x-frontend.breadcrumb :title="__('Құжаттар')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('Құжаттар')]]" />
<!-- breadcrumb-area-end -->

<!-- Documents Section -->
<section class="documents-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header text-center mb-5">
                    <h1 class="display-4 fw-bold text-primary mb-3">{{ __('Құжаттар') }}</h1>
                    <p class="lead text-muted">{{ __('Біліктілікті арттыру және қосымша білім беру институтының нормативтік құжаттары, бұйрықтары және нұсқаулықтары') }}</p>
                </div>

                <!-- Tabs Navigation -->
                <div class="documents-tabs mb-5">
                    <ul class="nav nav-tabs nav-fill" id="documentsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="normative-tab" data-bs-toggle="tab" data-bs-target="#normative" type="button" role="tab">
                                <i class="fas fa-file-contract me-2"></i>{{ __('Нормативтік құжаттар') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab">
                                <i class="fas fa-file-signature me-2"></i>{{ __('Бұйрықтар') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="manuals-tab" data-bs-toggle="tab" data-bs-target="#manuals" type="button" role="tab">
                                <i class="fas fa-book me-2"></i>{{ __('Нұсқаулықтар') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="templates-tab" data-bs-toggle="tab" data-bs-target="#templates" type="button" role="tab">
                                <i class="fas fa-file-alt me-2"></i>{{ __('Құжат үлгілері') }}
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="tab-content" id="documentsTabContent">
                    <!-- Нормативтік құжаттар -->
                    <div class="tab-pane fade show active" id="normative" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-6 col-md-6">
                                <div class="document-card h-100">
                                    <div class="document-icon">
                                        <i class="fas fa-file-contract fa-2x text-primary"></i>
                                    </div>
                                    <div class="document-content">
                                        <h5 class="document-title">{{ __('Білім беру қызметі туралы заң') }}</h5>
                                        <p class="document-description">{{ __('Білім беру қызметінің нормативтік негіздері') }}</p>
                                        <div class="document-meta">
                                            <span class="badge bg-light text-dark me-2">{{ __('Жарияланған күні') }}: 15.01.2023</span>
                                            <span class="badge bg-info me-2">PDF</span>
                                            <span class="badge bg-secondary">2.1 MB</span>
                                        </div>
                                        <a href="#" class="btn btn-primary mt-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="document-card h-100">
                                    <div class="document-icon">
                                        <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                                    </div>
                                    <div class="document-content">
                                        <h5 class="document-title">{{ __('Біліктілікті арттыру ережелері') }}</h5>
                                        <p class="document-description">{{ __('Педагогикалық қызметкерлердің біліктілігін арттыру ережелері') }}</p>
                                        <div class="document-meta">
                                            <span class="badge bg-light text-dark me-2">{{ __('Жарияланған күні') }}: 20.01.2023</span>
                                            <span class="badge bg-info me-2">PDF</span>
                                            <span class="badge bg-secondary">1.8 MB</span>
                                        </div>
                                        <a href="#" class="btn btn-primary mt-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Бұйрықтар -->
                    <div class="tab-pane fade" id="orders" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-6 col-md-6">
                                <div class="document-card h-100">
                                    <div class="document-icon">
                                        <i class="fas fa-file-signature fa-2x text-primary"></i>
                                    </div>
                                    <div class="document-content">
                                        <h5 class="document-title">{{ __('Білім беру министрлігінің бұйрығы') }}</h5>
                                        <p class="document-description">{{ __('Біліктілікті арттыру курстары туралы бұйрық') }}</p>
                                        <div class="document-meta">
                                            <span class="badge bg-light text-dark me-2">{{ __('Жарияланған күні') }}: 10.02.2023</span>
                                            <span class="badge bg-info me-2">PDF</span>
                                            <span class="badge bg-secondary">1.5 MB</span>
                                        </div>
                                        <a href="#" class="btn btn-primary mt-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="document-card h-100">
                                    <div class="document-icon">
                                        <i class="fas fa-clipboard-list fa-2x text-primary"></i>
                                    </div>
                                    <div class="document-content">
                                        <h5 class="document-title">{{ __('Курс бағдарламасы бұйрығы') }}</h5>
                                        <p class="document-description">{{ __('Курс бағдарламасын бекіту туралы бұйрық') }}</p>
                                        <div class="document-meta">
                                            <span class="badge bg-light text-dark me-2">{{ __('Жарияланған күні') }}: 25.02.2023</span>
                                            <span class="badge bg-info me-2">PDF</span>
                                            <span class="badge bg-secondary">2.3 MB</span>
                                        </div>
                                        <a href="#" class="btn btn-primary mt-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Нұсқаулықтар -->
                    <div class="tab-pane fade" id="manuals" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-6 col-md-6">
                                <div class="document-card h-100">
                                    <div class="document-icon">
                                        <i class="fas fa-book fa-2x text-primary"></i>
                                    </div>
                                    <div class="document-content">
                                        <h5 class="document-title">{{ __('Оқытушылар нұсқаулығы') }}</h5>
                                        <p class="document-description">{{ __('Курс оқытушыларына арналған нұсқаулық') }}</p>
                                        <div class="document-meta">
                                            <span class="badge bg-light text-dark me-2">{{ __('Жарияланған күні') }}: 05.03.2023</span>
                                            <span class="badge bg-info me-2">PDF</span>
                                            <span class="badge bg-secondary">3.2 MB</span>
                                        </div>
                                        <a href="#" class="btn btn-primary mt-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="document-card h-100">
                                    <div class="document-icon">
                                        <i class="fas fa-users fa-2x text-primary"></i>
                                    </div>
                                    <div class="document-content">
                                        <h5 class="document-title">{{ __('Студенттер нұсқаулығы') }}</h5>
                                        <p class="document-description">{{ __('Курсқа қатысушыларға арналған нұсқаулық') }}</p>
                                        <div class="document-meta">
                                            <span class="badge bg-light text-dark me-2">{{ __('Жарияланған күні') }}: 12.03.2023</span>
                                            <span class="badge bg-info me-2">PDF</span>
                                            <span class="badge bg-secondary">2.8 MB</span>
                                        </div>
                                        <a href="#" class="btn btn-primary mt-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Құжат үлгілері -->
                    <div class="tab-pane fade" id="templates" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-6 col-md-6">
                                <div class="document-card h-100">
                                    <div class="document-icon">
                                        <i class="fas fa-file-alt fa-2x text-primary"></i>
                                    </div>
                                    <div class="document-content">
                                        <h5 class="document-title">{{ __('Өтініш формасы') }}</h5>
                                        <p class="document-description">{{ __('Курсқа қатысу үшін өтініш формасының үлгісі') }}</p>
                                        <div class="document-meta">
                                            <span class="badge bg-light text-dark me-2">{{ __('Жарияланған күні') }}: 01.02.2023</span>
                                            <span class="badge bg-success me-2">DOCX</span>
                                            <span class="badge bg-secondary">420 KB</span>
                                        </div>
                                        <a href="#" class="btn btn-primary mt-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="document-card h-100">
                                    <div class="document-icon">
                                        <i class="fas fa-clipboard-check fa-2x text-primary"></i>
                                    </div>
                                    <div class="document-content">
                                        <h5 class="document-title">{{ __('Курс бағдарламасының үлгісі') }}</h5>
                                        <p class="document-description">{{ __('Курс бағдарламасын әзірлеуге арналған үлгі') }}</p>
                                        <div class="document-meta">
                                            <span class="badge bg-light text-dark me-2">{{ __('Жарияланған күні') }}: 15.02.2023</span>
                                            <span class="badge bg-success me-2">DOCX</span>
                                            <span class="badge bg-secondary">523 KB</span>
                                        </div>
                                        <a href="#" class="btn btn-primary mt-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="document-card h-100">
                                    <div class="document-icon">
                                        <i class="fas fa-chart-bar fa-2x text-primary"></i>
                                    </div>
                                    <div class="document-content">
                                        <h5 class="document-title">{{ __('Есеп беру формасы') }}</h5>
                                        <p class="document-description">{{ __('Курс нәтижелері бойынша есеп беру формасының үлгісі') }}</p>
                                        <div class="document-meta">
                                            <span class="badge bg-light text-dark me-2">{{ __('Жарияланған күні') }}: 20.02.2023</span>
                                            <span class="badge bg-success me-2">DOCX</span>
                                            <span class="badge bg-secondary">486 KB</span>
                                        </div>
                                        <a href="#" class="btn btn-primary mt-3">
                                            <i class="fas fa-download me-2"></i>{{ __('Жүктеу') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Help Section -->
<section class="help-section bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="help-content">
                    <h3 class="fw-bold mb-4">{{ __('Құжаттарды табу') }}</h3>
                    <p class="lead mb-4">{{ __('Егер сізге қажетті құжатты таба алмасаңыз, бізбен байланысыңыз. Біз сізге көмектесеміз.') }}</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-question-circle me-2"></i>{{ __('Көмек алу') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
<style>
.documents-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.document-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e9ecef;
}

.document-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.document-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-bottom: 1.5rem;
}

.document-title {
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #2c3e50;
}

.document-description {
    color: #6c757d;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.document-meta {
    margin-bottom: 1rem;
}

.badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.75rem;
}

.nav-tabs {
    border-bottom: 2px solid #e9ecef;
}

.nav-tabs .nav-link {
    border: none;
    border-radius: 25px 25px 0 0;
    padding: 1rem 1.5rem;
    font-weight: 500;
    color: #6c757d;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
    background-color: #f8f9fa;
    color: #495057;
}

.nav-tabs .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
}

.tab-content {
    padding: 2rem 0;
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

.help-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.help-content h3 {
    color: white;
}

.help-content p {
    color: rgba(255, 255, 255, 0.9);
}

.help-section .btn-primary {
    background: white;
    color: #667eea;
    border: 2px solid white;
}

.help-section .btn-primary:hover {
    background: transparent;
    color: white;
    border-color: white;
}
</style>
@endpush