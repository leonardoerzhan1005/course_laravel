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
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('application-form.store') }}" class="application-form">
                            @csrf
                            
                            <!-- Личные данные (кириллица) -->
                            <div class="form-section">
                                <h4 class="section-title">{{ __('Личные данные (кириллица)') }}</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name_cyrillic">{{ __('Фамилия') }} *</label>
                                            <input type="text" id="last_name_cyrillic" name="last_name_cyrillic" 
                                                   class="form-control @error('last_name_cyrillic') is-invalid @enderror" 
                                                   value="{{ old('last_name_cyrillic') }}" required>
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
                                                   value="{{ old('first_name_cyrillic') }}" required>
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
                                                   value="{{ old('middle_name_cyrillic') }}" required>
                                            @error('middle_name_cyrillic')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Личные данные (латиница) -->
                            <div class="form-section">
                                <h4 class="section-title">{{ __('Личные данные (латиница)') }}</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name_latin">{{ __('Фамилия') }} *</label>
                                            <input type="text" id="last_name_latin" name="last_name_latin" 
                                                   class="form-control @error('last_name_latin') is-invalid @enderror" 
                                                   value="{{ old('last_name_latin') }}" required>
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
                                                   value="{{ old('first_name_latin') }}" required>
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
                                                   value="{{ old('middle_name_latin') }}" required>
                                            @error('middle_name_latin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Гражданство -->
                            <div class="form-section">
                                <h4 class="section-title">{{ __('Гражданство') }}</h4>
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
                                <h4 class="section-title">{{ __('Контактная информация') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('E-mail') }} *</label>
                                            <input type="email" id="email" name="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   value="{{ old('email') }}" required>
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
                                <h4 class="section-title">{{ __('Образование и работа') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course_direction">{{ __('Направление курса') }} *</label>
                                            <select id="course_direction" name="course_direction" 
                                                    class="form-control @error('course_direction') is-invalid @enderror" required>
                                                <option value="">{{ __('Выберите направление') }}</option>
                                                @if(isset($courseCategories) && $courseCategories->count() > 0)
                                                    @foreach($courseCategories as $category)
                                                        <option value="{{ $category->name }}" {{ old('course_direction') == $category->name ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="it">{{ __('Информационные технологии') }}</option>
                                                    <option value="pedagogy">{{ __('Педагогика') }}</option>
                                                    <option value="medicine">{{ __('Медицина') }}</option>
                                                    <option value="economics">{{ __('Экономика') }}</option>
                                                    <option value="law">{{ __('Юриспруденция') }}</option>
                                                @endif
                                            </select>
                                            @error('course_direction')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="workplace">{{ __('Место работы') }} *</label>
                                            <input type="text" id="workplace" name="workplace" 
                                                   class="form-control @error('workplace') is-invalid @enderror" 
                                                   value="{{ old('workplace') }}" required>
                                            @error('workplace')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                </div>
                                <div class="row">
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
                                    <div class="col-md-6" id="other_institution_type_div" style="display: none;">
                                        <div class="form-group">
                                            <label for="other_institution_type">{{ __('Другой тип учреждения') }} *</label>
                                            <input type="text" id="other_institution_type" name="other_institution_type" 
                                                   class="form-control @error('other_institution_type') is-invalid @enderror" 
                                                   value="{{ old('other_institution_type') }}">
                                            @error('other_institution_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position">{{ __('Должность') }} *</label>
                                            <input type="text" id="position" name="position" 
                                                   class="form-control @error('position') is-invalid @enderror" 
                                                   value="{{ old('position') }}" required>
                                            @error('position')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="teaching_subjects">{{ __('Преподаваемые предметы') }} *</label>
                                            <select id="teaching_subjects" name="teaching_subjects[]" 
                                                    class="form-control select2 @error('teaching_subjects') is-invalid @enderror" 
                                                    multiple required>
                                                <option value="mathematics">{{ __('Математика') }}</option>
                                                <option value="physics">{{ __('Физика') }}</option>
                                                <option value="chemistry">{{ __('Химия') }}</option>
                                                <option value="biology">{{ __('Биология') }}</option>
                                                <option value="history">{{ __('История') }}</option>
                                                <option value="literature">{{ __('Литература') }}</option>
                                                <option value="english">{{ __('Английский язык') }}</option>
                                                <option value="russian">{{ __('Русский язык') }}</option>
                                                <option value="geography">{{ __('География') }}</option>
                                                <option value="computer_science">{{ __('Информатика') }}</option>
                                                <option value="art">{{ __('ИЗО') }}</option>
                                                <option value="music">{{ __('Музыка') }}</option>
                                                <option value="physical_education">{{ __('Физкультура') }}</option>
                                                <option value="other">{{ __('Другое') }}</option>
                                            </select>
                                            @error('teaching_subjects')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Курс и даты -->
                            <div class="form-section">
                                <h4 class="section-title">{{ __('Курс и даты') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course_id">{{ __('Курс повышения квалификации') }} *</label>
                                            <select id="course_id" name="course_id" 
                                                    class="form-control @error('course_id') is-invalid @enderror" required>
                                                <option value="">{{ __('Выберите курс') }}</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                        {{ $course->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="specialty_id">{{ __('Уровень курса') }} *</label>
                                            <select id="specialty_id" name="specialty_id" 
                                                    class="form-control @error('specialty_id') is-invalid @enderror" required>
                                                <option value="">{{ __('Выберите уровень') }}</option>
                                                @if(isset($courseLevels) && $courseLevels->count() > 0)
                                                    @foreach($courseLevels as $level)
                                                        <option value="{{ $level->id }}" {{ old('specialty_id') == $level->id ? 'selected' : '' }}>
                                                            {{ $level->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="1">{{ __('Начальный') }}</option>
                                                    <option value="2">{{ __('Средний') }}</option>
                                                    <option value="3">{{ __('Продвинутый') }}</option>
                                                @endif
                                            </select>
                                            @error('specialty_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="course_language">{{ __('Язык прохождения курса') }} *</label>
                                            <select id="course_language" name="course_language" 
                                                    class="form-control @error('course_language') is-invalid @enderror" required>
                                                <option value="">{{ __('Выберите язык') }}</option>
                                                @if(isset($courseLanguages) && $courseLanguages->count() > 0)
                                                    @foreach($courseLanguages as $language)
                                                        <option value="{{ $language->id }}" {{ old('course_language') == $language->id ? 'selected' : '' }}>
                                                            {{ $language->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="1">{{ __('Русский') }}</option>
                                                    <option value="2">{{ __('Английский') }}</option>
                                                    <option value="3">{{ __('Казахский') }}</option>
                                                @endif
                                            </select>
                                            @error('course_language')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="seminar_start_date">{{ __('Дата начала семинара') }} *</label>
                                            <input type="date" id="seminar_start_date" name="seminar_start_date" 
                                                   class="form-control @error('seminar_start_date') is-invalid @enderror" 
                                                   value="{{ old('seminar_start_date') }}" required>
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
                                <button type="submit" class="btn btn-primary btn-lg">{{ __('Отправить заявку') }}</button>
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
<script>
$(document).ready(function() {
    // Инициализация Select2
    $('.select2').select2({
        placeholder: 'Выберите предметы',
        allowClear: true
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
            });
        } else {
            citySelect.html('<option value="">{{ __("Сначала выберите страну") }}</option>');
        }
    });

    // Обработка изменения курса (оставляем для совместимости)
    $('#course_id').change(function() {
        // Уровень курса теперь не зависит от выбора курса
        // Можно добавить дополнительную логику при необходимости
    });

    // Обработка изменения категории учреждения
    $('#institution_category').change(function() {
        var category = $(this).val();
        if (category === 'other') {
            $('#other_institution_type_div').show();
            $('#other_institution_type').prop('required', true);
        } else {
            $('#other_institution_type_div').hide();
            $('#other_institution_type').prop('required', false);
        }
    });

    // Маска для телефона
    $('#phone').mask('+7 (000) 000-00-00');

    // Валидация дат
    $('#seminar_end_date').change(function() {
        var startDate = $('#seminar_start_date').val();
        var endDate = $(this).val();
        
        if (startDate && endDate && startDate >= endDate) {
            alert('Дата окончания должна быть после даты начала');
            $(this).val('');
        }
    });
});
</script>
@endpush

@push('styles')
<style>
.application-form-wrapper {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.form-section {
    margin-bottom: 40px;
    padding: 30px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    background: #f8f9fa;
}

.section-title {
    color: #2c3e50;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid #3498db;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 6px;
    padding: 12px 15px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.radio-group {
    display: flex;
    gap: 20px;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-check-input {
    width: 18px;
    height: 18px;
}

.form-submit {
    margin-top: 40px;
}

.btn-primary {
    background: #3498db;
    border: none;
    padding: 15px 40px;
    font-size: 18px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #2980b9;
    transform: translateY(-2px);
}

.alert {
    border-radius: 8px;
    margin-bottom: 30px;
}

.select2-container--default .select2-selection--multiple {
    border: 2px solid #e9ecef;
    border-radius: 6px;
    min-height: 45px;
}

.select2-container--default .select2-selection--multiple:focus {
    border-color: #3498db;
}
</style>
@endpush 