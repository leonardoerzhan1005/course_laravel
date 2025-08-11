@extends('frontend.layouts.master')

@section('title')
    {{ __('Анкета регистрации на курсы повышения квалификации') }}
@endsection

@section('contents')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">{{ __('Анкета регистрации на курсы повышения квалификации') }}</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Главная') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Анкета') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- application-form-area -->
    <section class="application-form-area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="application-form-wrapper">
                        <div class="section-title text-center mb-5">
                            <h2 class="title">{{ __('Анкета регистрации на курсы повышения квалификации') }}</h2>
                            <p class="text">{{ __('Заполните все поля для подачи заявки на курс повышения квалификации') }}</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('application-form.store') }}" class="application-form" id="applicationForm">
                            @csrf
                            
                            <!-- Личные данные (кириллица) -->
                            <div class="form-section">
                                <h4 class="section-title">
                                    <i class="fas fa-user me-2"></i>
                                    {{ __('Личные данные (кириллица)') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name_cyrillic">{{ __('Фамилия') }} *</label>
                                            <input type="text" id="last_name_cyrillic" name="last_name_cyrillic" 
                                                   class="form-control @error('last_name_cyrillic') is-invalid @enderror" 
                                                   value="{{ old('last_name_cyrillic') }}" 
                                                   placeholder="{{ __('Введите фамилию') }}" required>
                                            @error('last_name_cyrillic')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name_cyrillic">{{ __('Имя') }} *</label>
                                            <input type="text" id="first_name_cyrillic" name="first_name_cyrillic" 
                                                   class="form-control @error('first_name_cyrillic') is-invalid @enderror" 
                                                   value="{{ old('first_name_cyrillic') }}" 
                                                   placeholder="{{ __('Введите имя') }}" required>
                                            @error('first_name_cyrillic')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name_cyrillic">{{ __('Отчество') }} *</label>
                                            <input type="text" id="middle_name_cyrillic" name="middle_name_cyrillic" 
                                                   class="form-control @error('middle_name_cyrillic') is-invalid @enderror" 
                                                   value="{{ old('middle_name_cyrillic') }}" 
                                                   placeholder="{{ __('Введите отчество') }}" required>
                                            @error('middle_name_cyrillic')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Личные данные (латиница) -->
                            <div class="form-section">
                                <h4 class="section-title">
                                    <i class="fas fa-globe me-2"></i>
                                    {{ __('Личные данные (латиница)') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name_latin">{{ __('Фамилия') }} *</label>
                                            <input type="text" id="last_name_latin" name="last_name_latin" 
                                                   class="form-control @error('last_name_latin') is-invalid @enderror" 
                                                   value="{{ old('last_name_latin') }}" 
                                                   placeholder="{{ __('Enter last name') }}" required>
                                            @error('last_name_latin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name_latin">{{ __('Имя') }} *</label>
                                            <input type="text" id="first_name_latin" name="first_name_latin" 
                                                   class="form-control @error('first_name_latin') is-invalid @enderror" 
                                                   value="{{ old('first_name_latin') }}" 
                                                   placeholder="{{ __('Enter first name') }}" required>
                                            @error('first_name_latin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name_latin">{{ __('Отчество') }} *</label>
                                            <input type="text" id="middle_name_latin" name="middle_name_latin" 
                                                   class="form-control @error('middle_name_latin') is-invalid @enderror" 
                                                   value="{{ old('middle_name_latin') }}" 
                                                   placeholder="{{ __('Enter middle name') }}" required>
                                            @error('middle_name_latin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Гражданство -->
                            <div class="form-section">
                                <h4 class="section-title">
                                    <i class="fas fa-passport me-2"></i>
                                    {{ __('Гражданство') }}
                                </h4>
                                <div class="form-group">
                                    <label>{{ __('Вы иностранный гражданин?') }} *</label>
                                    <div class="radio-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_foreign_citizen" 
                                                   id="foreign_yes" value="1" {{ old('is_foreign_citizen') == '1' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="foreign_yes">{{ __('Да') }}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_foreign_citizen" 
                                                   id="foreign_no" value="0" {{ old('is_foreign_citizen') == '0' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="foreign_no">{{ __('Нет') }}</label>
                                        </div>
                                    </div>
                                    @error('is_foreign_citizen')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Контактная информация -->
                            <div class="form-section">
                                <h4 class="section-title">
                                    <i class="fas fa-address-book me-2"></i>
                                    {{ __('Контактная информация') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('E-mail') }} *</label>
                                            <input type="email" id="email" name="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   value="{{ old('email') }}" 
                                                   placeholder="{{ __('example@email.com') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('Мобильный телефон') }} *</label>
                                            <input type="tel" id="phone" name="phone" 
                                                   class="form-control @error('phone') is-invalid @enderror" 
                                                   value="{{ old('phone') }}" 
                                                   placeholder="+7 (XXX) XXX-XX-XX" required>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Образование и работа -->
                            <div class="form-section">
                                <h4 class="section-title">
                                    <i class="fas fa-graduation-cap me-2"></i>
                                    {{ __('Образование и работа') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="faculty_id">{{ __('Направление курса') }} *</label>
                                            <select id="faculty_id" name="faculty_id" 
                                                    class="form-control @error('faculty_id') is-invalid @enderror" required>
                                                <option value="">{{ __('Выберите направление') }}</option>
                                                @if(isset($faculties) && $faculties->count() > 0)
                                                    @foreach($faculties->where('id', '!=', '0') as $faculty)
                                                        <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                                                            {{ $faculty->name_ru ?? $faculty->name ?? 'Без названия' }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="1">{{ __('Информационные технологии') }}</option>
                                                    <option value="2">{{ __('Педагогика') }}</option>
                                                    <option value="3">{{ __('Медицина') }}</option>
                                                    <option value="4">{{ __('Экономика') }}</option>
                                                    <option value="5">{{ __('Юриспруденция') }}</option>
                                                @endif
                                            </select>
                                            @error('faculty_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="specialization_id">{{ __('Специализация') }} *</label>
                                            <select id="specialization_id" name="specialization_id" 
                                                    class="form-control @error('specialization_id') is-invalid @enderror" required>
                                                <option value="">{{ __('Сначала выберите направление') }}</option>
                                            </select>
                                            @error('specialization_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="workplace">{{ __('Место работы') }} *</label>
                                            <input type="text" id="workplace" name="workplace" 
                                                   class="form-control @error('workplace') is-invalid @enderror" 
                                                   value="{{ old('workplace') }}" 
                                                   placeholder="{{ __('Название организации') }}" required>
                                            @error('workplace')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country_id">{{ __('Страна') }} *</label>
                                            <select id="country_id" name="country_id" 
                                                    class="form-control @error('country_id') is-invalid @enderror" required>
                                                <option value="">{{ __('Выберите страну') }}</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city_id">{{ __('Город') }} *</label>
                                            <select id="city_id" name="city_id" 
                                                    class="form-control @error('city_id') is-invalid @enderror" required>
                                                <option value="">{{ __('Сначала выберите страну') }}</option>
                                            </select>
                                            @error('city_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="institution_category">{{ __('Категория учреждения') }} *</label>
                                            <select id="institution_category" name="institution_category" 
                                                    class="form-control @error('institution_category') is-invalid @enderror" required>
                                                <option value="">{{ __('Выберите категорию') }}</option>
                                                <option value="school" {{ old('institution_category') == 'school' ? 'selected' : '' }}>{{ __('Школа') }}</option>
                                                <option value="college" {{ old('institution_category') == 'college' ? 'selected' : '' }}>{{ __('Колледж') }}</option>
                                                <option value="university" {{ old('institution_category') == 'university' ? 'selected' : '' }}>{{ __('Университет') }}</option>
                                                <option value="institute" {{ old('institution_category') == 'institute' ? 'selected' : '' }}>{{ __('Институт') }}</option>
                                                <option value="other" {{ old('institution_category') == 'other' ? 'selected' : '' }}>{{ __('Другое') }}</option>
                                            </select>
                                            @error('institution_category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" id="other_institution_type_div" style="display: none;">
                                        <div class="form-group">
                                            <label for="other_institution_type">{{ __('Другой тип учреждения') }} *</label>
                                            <input type="text" id="other_institution_type" name="other_institution_type" 
                                                   class="form-control @error('other_institution_type') is-invalid @enderror" 
                                                   value="{{ old('other_institution_type') }}"
                                                   placeholder="{{ __('Укажите тип учреждения') }}">
                                            @error('other_institution_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="academic_degree">{{ __('Учёная степень') }} *</label>
                                            <select id="academic_degree" name="academic_degree" 
                                                    class="form-control @error('academic_degree') is-invalid @enderror" required>
                                                <option value="">{{ __('Выберите степень') }}</option>
                                                <option value="bachelor" {{ old('academic_degree') == 'bachelor' ? 'selected' : '' }}>{{ __('Бакалавр') }}</option>
                                                <option value="master" {{ old('academic_degree') == 'master' ? 'selected' : '' }}>{{ __('Магистр') }}</option>
                                                <option value="phd" {{ old('academic_degree') == 'phd' ? 'selected' : '' }}>{{ __('Кандидат наук') }}</option>
                                                <option value="doctor" {{ old('academic_degree') == 'doctor' ? 'selected' : '' }}>{{ __('Доктор наук') }}</option>
                                                <option value="none" {{ old('academic_degree') == 'none' ? 'selected' : '' }}>{{ __('Нет степени') }}</option>
                                            </select>
                                            @error('academic_degree')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position">{{ __('Должность') }} *</label>
                                            <input type="text" id="position" name="position" 
                                                   class="form-control @error('position') is-invalid @enderror" 
                                                   value="{{ old('position') }}" 
                                                   placeholder="{{ __('Укажите должность') }}" required>
                                            @error('position')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teaching_subjects">{{ __('Преподаваемые предметы') }}</label>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="not_teaching" name="not_teaching" value="1">
                                                <label class="form-check-label" for="not_teaching">
                                                    {{ __('Я не преподаю предметы') }}
                                                </label>
                                            </div>
                                            
                                            <div id="subjects_container">
                                                <select id="teaching_subjects" name="teaching_subjects[]" 
                                                        class="form-control select2 @error('teaching_subjects') is-invalid @enderror" 
                                                        multiple>
                                                    <optgroup label="{{ __('Точные науки') }}">
                                                        <option value="Математика">{{ __('Математика') }}</option>
                                                        <option value="Физика">{{ __('Физика') }}</option>
                                                        <option value="Химия">{{ __('Химия') }}</option>
                                                    </optgroup>
                                                    <optgroup label="{{ __('Естественные науки') }}">
                                                        <option value="Биология">{{ __('Биология') }}</option>
                                                        <option value="География">{{ __('География') }}</option>
                                                    </optgroup>
                                                    <optgroup label="{{ __('Гуманитарные науки') }}">
                                                        <option value="История">{{ __('История') }}</option>
                                                        <option value="Литература">{{ __('Литература') }}</option>
                                                    </optgroup>
                                                    <optgroup label="{{ __('Языки') }}">
                                                        <option value="Русский язык">{{ __('Русский язык') }}</option>
                                                        <option value="Английский язык">{{ __('Английский язык') }}</option>
                                                        <option value="Казахский язык">{{ __('Казахский язык') }}</option>
                                                    </optgroup>
                                                    <optgroup label="{{ __('Технические науки') }}">
                                                        <option value="Информатика">{{ __('Информатика') }}</option>
                                                        <option value="Программирование">{{ __('Программирование') }}</option>
                                                    </optgroup>
                                                    <optgroup label="{{ __('Творческие предметы') }}">
                                                        <option value="ИЗО">{{ __('ИЗО') }}</option>
                                                        <option value="Музыка">{{ __('Музыка') }}</option>
                                                        <option value="Физкультура">{{ __('Физкультура') }}</option>
                                                    </optgroup>
                                                    <optgroup label="{{ __('Экономические науки') }}">
                                                        <option value="Экономика">{{ __('Экономика') }}</option>
                                                        <option value="Бухгалтерия">{{ __('Бухгалтерия') }}</option>
                                                    </optgroup>
                                                    <optgroup label="{{ __('Медицинские науки') }}">
                                                        <option value="Анатомия">{{ __('Анатомия') }}</option>
                                                        <option value="Физиология">{{ __('Физиология') }}</option>
                                                    </optgroup>
                                                </select>
                                                
                                                <div class="mt-2">
                                                    <label for="other_subjects">{{ __('Другие предметы (если не указаны выше)') }}</label>
                                                    <input type="text" id="other_subjects" name="other_subjects" 
                                                           class="form-control" 
                                                           placeholder="{{ __('Укажите через запятую, если преподаете другие предметы') }}">
                                                    <small class="form-text text-muted">{{ __('Например: Психология, Социология, Философия') }}</small>
                                                </div>
                                            </div>
                                            
                                            @error('teaching_subjects')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Курс и даты -->
                            <div class="form-section">
                                <h4 class="section-title">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    {{ __('Курс и даты') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course_id">{{ __('Курс повышения квалификации') }} *</label>
                                            <select id="course_id" name="course_id" 
                                                    class="form-control @error('course_id') is-invalid @enderror" required>
                                                <option value="">{{ __('Сначала выберите направление') }}</option>
                                            </select>
                                            @error('course_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course_language">{{ __('Язык прохождения курса') }} *</label>
                                            <select id="course_language" name="course_language" 
                                                    class="form-control @error('course_language') is-invalid @enderror" required>
                                                <option value="">{{ __('Выберите язык') }}</option>
                                                @if(isset($courseLanguages) && $courseLanguages->count() > 0)
                                                    @foreach($courseLanguages as $language)
                                                        <option value="{{ $language->code }}" {{ old('course_language') == $language->code ? 'selected' : '' }}>
                                                            {{ $language->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="ru">{{ __('Русский') }}</option>
                                                    <option value="en">{{ __('Английский') }}</option>
                                                    <option value="kk">{{ __('Казахский') }}</option>
                                                @endif
                                            </select>
                                            @error('course_language')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="seminar_start_date">{{ __('Дата начала семинара') }} *</label>
                                            <input type="date" id="seminar_start_date" name="seminar_start_date" 
                                                   class="form-control @error('seminar_start_date') is-invalid @enderror" 
                                                   value="{{ old('seminar_start_date') }}" 
                                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                            @error('seminar_start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="seminar_end_date">{{ __('Дата окончания семинара') }} *</label>
                                            <input type="date" id="seminar_end_date" name="seminar_end_date" 
                                                   class="form-control @error('seminar_end_date') is-invalid @enderror" 
                                                   value="{{ old('seminar_end_date') }}" required>
                                            @error('seminar_end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-submit text-center">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    {{ __('Отправить заявку') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- application-form-area-end -->
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Инициализация Select2
    $('.select2').select2({
        placeholder: '{{ __("Выберите предметы") }}',
        allowClear: true,
        language: '{{ app()->getLocale() }}'
    });

    // Обработка изменения страны
    $('#country_id').change(function() {
        var countryId = $(this).val();
        var citySelect = $('#city_id');
        
        citySelect.html('<option value="">{{ __("Загрузка...") }}</option>');
        
        if (countryId) {
            $.get('/get-cities/' + countryId, function(data) {
                citySelect.html('<option value="">{{ __("Выберите город") }}</option>');
                $.each(data, function(key, city) {
                    citySelect.append('<option value="' + city.id + '">' + city.name + '</option>');
                });
            }).fail(function() {
                citySelect.html('<option value="">{{ __("Ошибка загрузки") }}</option>');
            });
        } else {
            citySelect.html('<option value="">{{ __("Сначала выберите страну") }}</option>');
        }
    });

    // Обработка изменения факультета (направления)
    $('#faculty_id').change(function() {
        var facultyId = $(this).val();
        var specializationSelect = $('#specialization_id');
        var courseSelect = $('#course_id');
        
        console.log('Факультет изменен:', facultyId);
        
        // Сброс специализаций и курсов
        specializationSelect.html('<option value="">{{ __("Загрузка...") }}</option>');
        courseSelect.html('<option value="">{{ __("Сначала выберите специализацию") }}</option>');
        
        if (facultyId) {
            // Загрузка специализаций для выбранного факультета
            $.get('/get-specializations-by-faculty', { faculty_id: facultyId }, function(data) {
                console.log('Получены специализации:', data);
                
                specializationSelect.html('<option value="">{{ __("Выберите специализацию") }}</option>');
                if (data.length > 0) {
                    $.each(data, function(key, specialization) {
                        specializationSelect.append('<option value="' + specialization.id + '">' + 
                            (specialization.name_ru || specialization.name_en || specialization.name_kz || 'Без названия') + '</option>');
                    });
                } else {
                    specializationSelect.html('<option value="">{{ __("Нет доступных специализаций") }}</option>');
                }
            }).fail(function() {
                console.error('Ошибка загрузки специализаций');
                specializationSelect.html('<option value="">{{ __("Ошибка загрузки") }}</option>');
            });
        } else {
            specializationSelect.html('<option value="">{{ __("Сначала выберите направление") }}</option>');
            courseSelect.html('<option value="">{{ __("Сначала выберите направление") }}</option>');
        }
    });

    // Обработка изменения специализации
    $('#specialization_id').change(function() {
        var specializationId = $(this).val();
        var courseSelect = $('#course_id');
        
        console.log('Специализация изменена:', specializationId);
        
        if (specializationId) {
            courseSelect.html('<option value="">{{ __("Загрузка...") }}</option>');
            
            // Загрузка курсов для выбранной специализации
            $.get('/get-courses-by-specialization', { specialization_id: specializationId }, function(data) {
                console.log('Получены курсы:', data);
                
                courseSelect.html('<option value="">{{ __("Выберите курс") }}</option>');
                if (data.length > 0) {
                    $.each(data, function(key, course) {
                        courseSelect.append('<option value="' + course.id + '">' + course.title + '</option>');
                    });
                } else {
                    courseSelect.html('<option value="">{{ __("Нет доступных курсов") }}</option>');
                }
            }).fail(function() {
                console.error('Ошибка загрузки курсов');
                courseSelect.html('<option value="">{{ __("Ошибка загрузки курсов") }}</option>');
            });
        } else {
            courseSelect.html('<option value="">{{ __("Сначала выберите специализацию") }}</option>');
        }
    });

    // Обработка изменения категории учреждения
    $('#institution_category').change(function() {
        var category = $(this).val();
        if (category === 'other') {
            $('#other_institution_type_div').show();
            $('#other_institution_type').prop('required', true);
        } else {
            $('#other_institution_type_div').hide();
            $('#other_institution_type').prop('required', false).val('');
        }
    });

    // Обработка поля "не преподаю предметы"
    $('#not_teaching').change(function() {
        var isChecked = $(this).is(':checked');
        var subjectsContainer = $('#subjects_container');
        var teachingSubjects = $('#teaching_subjects');
        var otherSubjects = $('#other_subjects');
        
        if (isChecked) {
            subjectsContainer.hide();
            teachingSubjects.prop('required', false).val(null).trigger('change');
            otherSubjects.prop('required', false).val('');
        } else {
            subjectsContainer.show();
            teachingSubjects.prop('required', true);
        }
    });

    // Валидация преподаваемых предметов
    $('#teaching_subjects').change(function() {
        var selectedSubjects = $(this).val();
        var otherSubjects = $('#other_subjects');
        
        if (selectedSubjects && selectedSubjects.length > 0) {
            otherSubjects.prop('required', false);
        } else {
            otherSubjects.prop('required', true);
        }
    });

    // Маска для телефона
    $('#phone').mask('+7 (000) 000-00-00');

    // Валидация дат
    $('#seminar_start_date').change(function() {
        var startDate = $(this).val();
        var endDateInput = $('#seminar_end_date');
        
        if (startDate) {
            endDateInput.attr('min', startDate);
            if (endDateInput.val() && endDateInput.val() <= startDate) {
                endDateInput.val('');
            }
        }
    });

    $('#seminar_end_date').change(function() {
        var startDate = $('#seminar_start_date').val();
        var endDate = $(this).val();
        
        if (startDate && endDate && startDate >= endDate) {
            alert('{{ __("Дата окончания должна быть после даты начала") }}');
            $(this).val('');
        }
    });

    // Обработка отправки формы
    $('#applicationForm').on('submit', function() {
        var submitBtn = $('#submitBtn');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>{{ __("Отправка...") }}');
        
        // Отладочная информация
        console.log('Отправка формы с данными:', {
            faculty_id: $('#faculty_id').val(),
            specialization_id: $('#specialization_id').val(),
            course_id: $('#course_id').val(),
            last_name_cyrillic: $('#last_name_cyrillic').val(),
            first_name_cyrillic: $('#first_name_cyrillic').val(),
            middle_name_cyrillic: $('#middle_name_cyrillic').val(),
            full_name_calculated: $('#last_name_cyrillic').val() + ' ' + $('#first_name_cyrillic').val() + ' ' + $('#middle_name_cyrillic').val()
        });
    });

    // Автозаполнение латинских полей на основе кириллических
    $('#last_name_cyrillic, #first_name_cyrillic, #middle_name_cyrillic').on('blur', function() {
        var cyrillicValue = $(this).val();
        var latinField = $(this).attr('id').replace('_cyrillic', '_latin');
        
        if (cyrillicValue && !$('#' + latinField).val()) {
            // Простая транслитерация (можно улучшить)
            var transliterated = cyrillicValue
                .replace(/а/g, 'a').replace(/б/g, 'b').replace(/в/g, 'v').replace(/г/g, 'g')
                .replace(/д/g, 'd').replace(/е/g, 'e').replace(/ё/g, 'yo').replace(/ж/g, 'zh')
                .replace(/з/g, 'z').replace(/и/g, 'i').replace(/й/g, 'y').replace(/к/g, 'k')
                .replace(/л/g, 'l').replace(/м/g, 'm').replace(/н/g, 'n').replace(/о/g, 'o')
                .replace(/п/g, 'p').replace(/р/g, 'r').replace(/с/g, 's').replace(/т/g, 't')
                .replace(/у/g, 'u').replace(/ф/g, 'f').replace(/х/g, 'kh').replace(/ц/g, 'ts')
                .replace(/ч/g, 'ch').replace(/ш/g, 'sh').replace(/щ/g, 'shch').replace(/ъ/g, '')
                .replace(/ы/g, 'y').replace(/ь/g, '').replace(/э/g, 'e').replace(/ю/g, 'yu')
                .replace(/я/g, 'ya');
            
            $('#' + latinField).val(transliterated);
        }
    });
});
</script>
@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.application-form-wrapper {
    background: #fff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.form-section {
    margin-bottom: 40px;
    padding: 30px;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    transition: all 0.3s ease;
}

.form-section:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.section-title {
    color: #2c3e50;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 3px solid #3498db;
    font-weight: 600;
    font-size: 1.25rem;
}

.section-title i {
    color: #3498db;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
    display: block;
    font-size: 0.95rem;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 15px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    transform: translateY(-1px);
}

.radio-group {
    display: flex;
    gap: 25px;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-check:hover {
    background: #f8f9fa;
}

.form-check-input {
    width: 20px;
    height: 20px;
    cursor: pointer;
}

.form-check-label {
    cursor: pointer;
    font-weight: 500;
}

.form-submit {
    margin-top: 50px;
}

.btn-primary {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    border: none;
    padding: 18px 45px;
    font-size: 18px;
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2980b9 0%, #1f5f8b 100%);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
}

.btn-primary:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.alert {
    border-radius: 12px;
    margin-bottom: 30px;
    border: none;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
}

.select2-container--default .select2-selection--multiple {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    min-height: 45px;
    transition: all 0.3s ease;
}

.select2-container--default .select2-selection--multiple:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background: #3498db;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 5px 10px;
    margin: 3px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white;
    margin-right: 8px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #f8f9fa;
}

/* Адаптивность */
@media (max-width: 768px) {
    .application-form-wrapper {
        padding: 20px;
    }
    
    .form-section {
        padding: 20px;
    }
    
    .radio-group {
        flex-direction: column;
        gap: 15px;
    }
    
    .btn-primary {
        padding: 15px 30px;
        font-size: 16px;
    }
}
</style>
@endpush
