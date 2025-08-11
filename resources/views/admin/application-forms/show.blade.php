@extends('admin.master_layout')
@section('title')
    <title>{{ __('Просмотр заявки') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Просмотр заявки') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.application-forms.index') }}">{{ __('Заявки на обучение') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Просмотр') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Заявка №') }} {{ $application->id }}</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.application-forms.edit', $application->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> {{ __('Редактировать') }}
                                    </a>
                                    <a href="{{ route('admin.application-forms.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> {{ __('Назад') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Основная информация -->
                                    <div class="col-md-6">
                                        <h5>{{ __('Основная информация') }}</h5>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>{{ __('ФИО (кириллица)') }}:</strong></td>
                                                <td>{{ $application->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('ФИО (латиница)') }}:</strong></td>
                                                <td>{{ $application->last_name_latin }} {{ $application->first_name_latin }} {{ $application->middle_name_latin }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Гражданство') }}:</strong></td>
                                                <td>
                                                    @if($application->is_foreign_citizen)
                                                        <span class="badge badge-info">{{ __('Иностранный гражданин') }}</span>
                                                    @else
                                                        <span class="badge badge-success">{{ __('Гражданин РК') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Email') }}:</strong></td>
                                                <td>{{ $application->email }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Телефон') }}:</strong></td>
                                                <td>{{ $application->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Статус') }}:</strong></td>
                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'pending' => 'warning',
                                                            'approved' => 'success',
                                                            'rejected' => 'danger',
                                                            'completed' => 'info'
                                                        ];
                                                        $statusNames = [
                                                            'pending' => 'Ожидает рассмотрения',
                                                            'approved' => 'Одобрена',
                                                            'rejected' => 'Отклонена',
                                                            'completed' => 'Завершена'
                                                        ];
                                                    @endphp
                                                    <span class="badge badge-{{ $statusColors[$application->status] ?? 'secondary' }}">
                                                        {{ $statusNames[$application->status] ?? $application->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Дата подачи') }}:</strong></td>
                                                <td>{{ $application->created_at->format('d.m.Y H:i') }}</td>
                                            </tr>
                                            @if($application->updated_at != $application->created_at)
                                                <tr>
                                                    <td><strong>{{ __('Последнее обновление') }}:</strong></td>
                                                    <td>{{ $application->updated_at->format('d.m.Y H:i') }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>

                                    <!-- Образовательная информация -->
                                    <div class="col-md-6">
                                        <h5>{{ __('Образовательная информация') }}</h5>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>{{ __('Факультет') }}:</strong></td>
                                                <td>{{ $application->faculty?->name_ru ?? 'Не указан' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Специализация') }}:</strong></td>
                                                <td>{{ $application->specialization?->name_ru ?? 'Не указана' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Курс') }}:</strong></td>
                                                <td>{{ $application->course?->title ?? 'Не выбран' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Место работы') }}:</strong></td>
                                                <td>{{ $application->workplace ?? 'Не указано' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Страна') }}:</strong></td>
                                                <td>{{ $application->country?->name ?? 'Не указана' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Город') }}:</strong></td>
                                                <td>{{ $application->city?->name ?? 'Не указан' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Категория учреждения') }}:</strong></td>
                                                <td>
                                                    @php
                                                        $categories = [
                                                            'school' => 'Школа',
                                                            'college' => 'Колледж',
                                                            'university' => 'Университет',
                                                            'institute' => 'Институт',
                                                            'other' => 'Другое'
                                                        ];
                                                    @endphp
                                                    {{ $categories[$application->institution_category] ?? $application->institution_category ?? 'Не указана' }}
                                                    @if($application->institution_category === 'other' && $application->other_institution_type)
                                                        ({{ $application->other_institution_type }})
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Ученая степень') }}:</strong></td>
                                                <td>
                                                    @php
                                                        $degrees = [
                                                            'bachelor' => 'Бакалавр',
                                                            'master' => 'Магистр',
                                                            'phd' => 'Кандидат наук',
                                                            'doctor' => 'Доктор наук',
                                                            'none' => 'Нет степени'
                                                        ];
                                                    @endphp
                                                    {{ $degrees[$application->academic_degree] ?? $application->academic_degree ?? 'Не указана' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('Должность') }}:</strong></td>
                                                <td>{{ $application->position ?? 'Не указана' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- Преподаваемые предметы -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5>{{ __('Преподаваемые предметы') }}</h5>
                                        @if($application->not_teaching)
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle"></i>
                                                {{ __('Заявитель указал, что не преподает предметы') }}
                                            </div>
                                        @elseif(is_array($application->teaching_subjects) && count($application->teaching_subjects) > 0)
                                            <div class="row">
                                                @foreach($application->teaching_subjects as $subject)
                                                    <div class="col-md-3 mb-2">
                                                        <span class="badge badge-primary">{{ $subject }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ __('Предметы не указаны') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Информация о курсе -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5>{{ __('Информация о курсе') }}</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td><strong>{{ __('Язык курса') }}:</strong></td>
                                                        <td>
                                                            @php
                                                                $languages = [
                                                                    'ru' => 'Русский',
                                                                    'en' => 'Английский',
                                                                    'kk' => 'Казахский'
                                                                ];
                                                            @endphp
                                                            {{ $languages[$application->course_language] ?? $application->course_language ?? 'Не указан' }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td><strong>{{ __('Дата начала') }}:</strong></td>
                                                        <td>{{ $application->seminar_start_date ? $application->seminar_start_date->format('d.m.Y') : 'Не указана' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td><strong>{{ __('Дата окончания') }}:</strong></td>
                                                        <td>{{ $application->seminar_end_date ? $application->seminar_end_date->format('d.m.Y') : 'Не указана' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Заметки администратора -->
                                @if($application->notes)
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h5>{{ __('Заметки администратора') }}</h5>
                                            <div class="alert alert-secondary">
                                                {{ $application->notes }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Действия -->
                                <div class="row mt-4">
                                    <div class="col-12 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.application-forms.edit', $application->id) }}" 
                                               class="btn btn-warning btn-lg">
                                                <i class="fas fa-edit"></i> {{ __('Редактировать') }}
                                            </a>
                                            
                                            <button type="button" class="btn btn-secondary btn-lg dropdown-toggle ml-2" 
                                                    data-toggle="dropdown" title="{{ __('Изменить статус') }}">
                                                <i class="fas fa-cog"></i> {{ __('Изменить статус') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                @foreach(['pending', 'approved', 'rejected', 'completed'] as $status)
                                                    @if($status != $application->status)
                                                        <a class="dropdown-item update-status" href="#" 
                                                           data-id="{{ $application->id }}" 
                                                           data-status="{{ $status }}">
                                                            {{ $statusNames[$status] }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                            
                                            <a href="{{ route('admin.application-forms.index') }}" class="btn btn-secondary btn-lg ml-2">
                                                <i class="fas fa-arrow-left"></i> {{ __('Назад к списку') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
    // Обработка изменения статуса
    $('.update-status').on('click', function(e) {
        e.preventDefault();
        
        const id = $(this).data('id');
        const status = $(this).data('status');
        
        if (confirm('Вы уверены, что хотите изменить статус заявки?')) {
            $.ajax({
                url: `/admin/application-forms/${id}/update-status`,
                method: 'PUT',
                data: {
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Ошибка при изменении статуса');
                    }
                },
                error: function() {
                    alert('Ошибка при изменении статуса');
                }
            });
        }
    });
});
</script>
@endpush
