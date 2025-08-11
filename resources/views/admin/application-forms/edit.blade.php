@extends('admin.master_layout')
@section('title')
    <title>{{ __('Редактировать заявку') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Редактировать заявку') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.application-forms.index') }}">{{ __('Заявки на обучение') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Редактировать') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Заявка №') }} {{ $application->id }} - {{ $application->full_name }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.application-forms.update', $application->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="full_name">{{ __('ФИО') }} *</label>
                                                <input type="text" id="full_name" name="full_name" 
                                                       class="form-control @error('full_name') is-invalid @enderror" 
                                                       value="{{ old('full_name', $application->full_name) }}" required>
                                                @error('full_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">{{ __('Email') }} *</label>
                                                <input type="email" id="email" name="email" 
                                                       class="form-control @error('email') is-invalid @enderror" 
                                                       value="{{ old('email', $application->email) }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">{{ __('Телефон') }} *</label>
                                                <input type="text" id="phone" name="phone" 
                                                       class="form-control @error('phone') is-invalid @enderror" 
                                                       value="{{ old('phone', $application->phone) }}" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">{{ __('Статус') }} *</label>
                                                <select id="status" name="status" 
                                                        class="form-control @error('status') is-invalid @enderror" required>
                                                    <option value="pending" {{ old('status', $application->status) == 'pending' ? 'selected' : '' }}>
                                                        {{ __('Ожидает рассмотрения') }}
                                                    </option>
                                                    <option value="approved" {{ old('status', $application->status) == 'approved' ? 'selected' : '' }}>
                                                        {{ __('Одобрена') }}
                                                    </option>
                                                    <option value="rejected" {{ old('status', $application->status) == 'rejected' ? 'selected' : '' }}>
                                                        {{ __('Отклонена') }}
                                                    </option>
                                                    <option value="completed" {{ old('status', $application->status) == 'completed' ? 'selected' : '' }}>
                                                        {{ __('Завершена') }}
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="faculty_id">{{ __('Факультет') }} *</label>
                                                <select id="faculty_id" name="faculty_id" 
                                                        class="form-control @error('faculty_id') is-invalid @enderror" required>
                                                    <option value="">{{ __('Выберите факультет') }}</option>
                                                    @foreach($faculties as $faculty)
                                                        <option value="{{ $faculty->id }}" {{ old('faculty_id', $application->faculty_id) == $faculty->id ? 'selected' : '' }}>
                                                            {{ $faculty->name_ru }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('faculty_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="specialty_id">{{ __('Специализация') }} *</label>
                                                <select id="specialty_id" name="specialty_id" 
                                                        class="form-control @error('specialty_id') is-invalid @enderror" required>
                                                    <option value="">{{ __('Сначала выберите факультет') }}</option>
                                                </select>
                                                @error('specialty_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_id">{{ __('Курс') }}</label>
                                                <select id="course_id" name="course_id" 
                                                        class="form-control @error('course_id') is-invalid @enderror">
                                                    <option value="">{{ __('Сначала выберите специализацию') }}</option>
                                                </select>
                                                @error('course_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" id="not_teaching" name="not_teaching" 
                                                           value="1" {{ old('not_teaching', $application->not_teaching) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="not_teaching">
                                                        {{ __('Не преподает предметы') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="subjects_container">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="teaching_subjects">{{ __('Преподаваемые предметы') }}</label>
                                                <select id="teaching_subjects" name="teaching_subjects[]" 
                                                        class="form-control select2" multiple>
                                                    @php
                                                        $categories = [
                                                            'exact' => 'Точные науки',
                                                            'natural' => 'Естественные науки',
                                                            'humanitarian' => 'Гуманитарные науки',
                                                            'language' => 'Языки',
                                                            'technical' => 'Технические науки',
                                                            'creative' => 'Творческие предметы',
                                                            'physical' => 'Физическая культура',
                                                            'economic' => 'Экономические науки',
                                                            'medical' => 'Медицинские науки',
                                                            'general' => 'Общие'
                                                        ];
                                                    @endphp
                                                    @foreach($categories as $key => $categoryName)
                                                        <optgroup label="{{ $categoryName }}">
                                                            @php
                                                                $subjects = \App\Models\TeachingSubject::where('category', $key)
                                                                    ->where('is_active', true)
                                                                    ->orderBy('sort_order')
                                                                    ->get();
                                                            @endphp
                                                            @foreach($subjects as $subject)
                                                                <option value="{{ $subject->name_ru }}" 
                                                                        {{ is_array($application->teaching_subjects) && in_array($subject->name_ru, $application->teaching_subjects) ? 'selected' : '' }}>
                                                                    {{ $subject->name_ru }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="other_subjects">{{ __('Другие предметы') }}</label>
                                                <textarea id="other_subjects" name="other_subjects" 
                                                          class="form-control" rows="3" 
                                                          placeholder="{{ __('Укажите другие предметы, если их нет в списке') }}">{{ old('other_subjects', '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="workplace">{{ __('Место работы') }} *</label>
                                                <input type="text" id="workplace" name="workplace" 
                                                       class="form-control @error('workplace') is-invalid @enderror" 
                                                       value="{{ old('workplace', $application->workplace) }}" required>
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
                                                    @foreach($countries ?? [] as $country)
                                                        <option value="{{ $country->id }}" {{ old('country_id', $application->country_id) == $country->id ? 'selected' : '' }}>
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
                                                    <option value="school" {{ old('institution_category', $application->institution_category) == 'school' ? 'selected' : '' }}>{{ __('Школа') }}</option>
                                                    <option value="college" {{ old('institution_category', $application->institution_category) == 'college' ? 'selected' : '' }}>{{ __('Колледж') }}</option>
                                                    <option value="university" {{ old('institution_category', $application->institution_category) == 'university' ? 'selected' : '' }}>{{ __('Университет') }}</option>
                                                    <option value="institute" {{ old('institution_category', $application->institution_category) == 'institute' ? 'selected' : '' }}>{{ __('Институт') }}</option>
                                                    <option value="other" {{ old('institution_category', $application->institution_category) == 'other' ? 'selected' : '' }}>{{ __('Другое') }}</option>
                                                </select>
                                                @error('institution_category')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="notes">{{ __('Заметки администратора') }}</label>
                                                <textarea id="notes" name="notes" 
                                                          class="form-control" rows="4" 
                                                          placeholder="{{ __('Добавьте заметки по заявке') }}">{{ old('notes', $application->notes) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-save"></i> {{ __('Обновить заявку') }}
                                        </button>
                                        <a href="{{ route('admin.application-forms.show', $application->id) }}" class="btn btn-secondary btn-lg ml-2">
                                            <i class="fas fa-eye"></i> {{ __('Просмотр') }}
                                        </a>
                                        <a href="{{ route('admin.application-forms.index') }}" class="btn btn-secondary btn-lg ml-2">
                                            <i class="fas fa-arrow-left"></i> {{ __('Назад') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Инициализация Select2
    $('.select2').select2({
        placeholder: 'Выберите предметы',
        allowClear: true
    });

    // Загрузка специализаций при выборе факультета
    $('#faculty_id').on('change', function() {
        const facultyId = $(this).val();
        const specialtySelect = $('#specialty_id');
        const courseSelect = $('#course_id');
        
        console.log('Факультет изменен:', facultyId);
        
        // Очищаем специализации и курсы
        specialtySelect.html('<option value="">{{ __("Сначала выберите факультет") }}</option>');
        courseSelect.html('<option value="">{{ __("Сначала выберите специализацию") }}</option>');
        
        if (facultyId) {
            console.log('Загружаем специализации для факультета:', facultyId);
            
            $.get('/get-specializations-by-faculty', { faculty_id: facultyId }, function(data) {
                console.log('Получены специализации:', data);
                
                if (data && data.length > 0) {
                    specialtySelect.html('<option value="">{{ __("Выберите специализацию") }}</option>');
                    data.forEach(function(spec) {
                        specialtySelect.append(`<option value="${spec.id}">${spec.name_ru}</option>`);
                    });
                } else {
                    specialtySelect.html('<option value="">{{ __("Для этого факультета нет доступных специализаций") }}</option>');
                }
                
                // Устанавливаем текущую специализацию
                const currentSpecialtyId = '{{ $application->specialty_id }}';
                if (currentSpecialtyId) {
                    specialtySelect.val(currentSpecialtyId);
                    // Триггерим изменение для загрузки курсов
                    specialtySelect.trigger('change');
                }
            }).fail(function(xhr, status, error) {
                console.error('Ошибка загрузки специализаций:', error);
                console.error('Статус:', xhr.status);
                console.error('Ответ:', xhr.responseText);
                specialtySelect.html('<option value="">{{ __("Ошибка загрузки") }}</option>');
            });
        }
    });

    // Загрузка курсов при выборе специализации
    $('#specialty_id').on('change', function() {
        const specialtyId = $(this).val();
        const courseSelect = $('#course_id');
        
        console.log('Специализация изменена:', specialtyId);
        
        courseSelect.html('<option value="">{{ __("Сначала выберите специализацию") }}</option>');
        
        if (specialtyId) {
            console.log('Загружаем курсы для специализации:', specialtyId);
            
            $.get('/get-courses-by-specialization', {specialization_id: specialtyId}, function(data) {
                console.log('Получены курсы:', data);
                
                if (data && data.length > 0) {
                    courseSelect.html('<option value="">{{ __("Выберите курс") }}</option>');
                    data.forEach(function(course) {
                        courseSelect.append(`<option value="${course.id}">${course.title}</option>`);
                    });
                } else {
                    courseSelect.html('<option value="">{{ __("Для этой специализации нет доступных курсов") }}</option>');
                }
                
                // Устанавливаем текущий курс
                const currentCourseId = '{{ $application->course_id }}';
                if (currentCourseId) {
                    courseSelect.val(currentCourseId);
                }
            }).fail(function(xhr, status, error) {
                console.error('Ошибка загрузки курсов:', error);
                console.error('Статус:', xhr.status);
                console.error('Ответ:', xhr.responseText);
                courseSelect.html('<option value="">{{ __("Ошибка загрузки курсов") }}</option>');
            });
        }
    });

    // Обработка чекбокса "Не преподает предметы"
    $('#not_teaching').on('change', function() {
        const isChecked = $(this).is(':checked');
        const subjectsContainer = $('#subjects_container');
        const teachingSubjects = $('#teaching_subjects');
        const otherSubjects = $('#other_subjects');
        
        if (isChecked) {
            subjectsContainer.hide();
            teachingSubjects.prop('required', false);
            otherSubjects.prop('required', false);
        } else {
            subjectsContainer.show();
            teachingSubjects.prop('required', true);
        }
    });

    // Управление required атрибутами
    $('#teaching_subjects').on('change', function() {
        const hasSelected = $(this).val() && $(this).val().length > 0;
        $('#other_subjects').prop('required', !hasSelected);
    });

    $('#other_subjects').on('input', function() {
        const hasText = $(this).val().trim().length > 0;
        $('#teaching_subjects').prop('required', !hasText);
    });

    // Инициализация при загрузке страницы
    if ($('#faculty_id').val()) {
        // Загружаем специализации для текущего факультета
        $('#faculty_id').trigger('change');
    }
    
    if ($('#not_teaching').is(':checked')) {
        $('#subjects_container').hide();
    }
    
    // Устанавливаем текущие значения для преподаваемых предметов
    const currentSubjects = @json($application->teaching_subjects ?? []);
    if (currentSubjects && currentSubjects.length > 0) {
        $('#teaching_subjects').val(currentSubjects).trigger('change');
    }
    
    // Загрузка городов при выборе страны
    $('#country_id').on('change', function() {
        const countryId = $(this).val();
        const citySelect = $('#city_id');
        
        citySelect.html('<option value="">{{ __("Загрузка...") }}</option>');
        
        if (countryId) {
            $.get('/get-cities/' + countryId, function(data) {
                citySelect.html('<option value="">{{ __("Выберите город") }}</option>');
                data.forEach(function(city) {
                    citySelect.append(`<option value="${city.id}">${city.name}</option>`);
                });
                
                // Устанавливаем текущий город
                const currentCityId = '{{ $application->city_id }}';
                if (currentCityId) {
                    citySelect.val(currentCityId);
                }
            }).fail(function() {
                citySelect.html('<option value="">{{ __("Ошибка загрузки") }}</option>');
            });
        } else {
            citySelect.html('<option value="">{{ __("Сначала выберите страну") }}</option>');
        }
    });
    
    // Инициализация городов при загрузке страницы
    if ($('#country_id').val()) {
        $('#country_id').trigger('change');
    }
});
</script>
@endpush
