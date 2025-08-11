@extends('admin.master_layout')
@section('title')
    <title>{{ __('Заявки на обучение') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Заявки на обучение') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Заявки на обучение') }}</div>
                </div>
            </div>

            <div class="section-body">
                <!-- Фильтры -->
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Фильтры') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.application-forms.index') }}" class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ __('Поиск') }}</label>
                                    <input type="text" name="search" class="form-control" 
                                           value="{{ request('search') }}" 
                                           placeholder="ФИО, Email, Телефон">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Статус') }}</label>
                                    <select name="status" class="form-control">
                                        <option value="">{{ __('Все статусы') }}</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            {{ __('Ожидает рассмотрения') }}
                                        </option>
                                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                            {{ __('Одобрена') }}
                                        </option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                            {{ __('Отклонена') }}
                                        </option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                            {{ __('Завершена') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Факультет') }}</label>
                                    <select name="faculty_id" class="form-control">
                                        <option value="">{{ __('Все факультеты') }}</option>
                                        @foreach($faculties as $faculty)
                                            <option value="{{ $faculty->id }}" {{ request('faculty_id') == $faculty->id ? 'selected' : '' }}>
                                                {{ $faculty->name_ru }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Специализация') }}</label>
                                    <select name="specialization_id" class="form-control">
                                        <option value="">{{ __('Все специализации') }}</option>
                                        @foreach($specializations as $spec)
                                            <option value="{{ $spec->id }}" {{ request('specialization_id') == $spec->id ? 'selected' : '' }}>
                                                {{ $spec->name_ru }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary mr-2">
                                            <i class="fas fa-search"></i> {{ __('Фильтровать') }}
                                        </button>
                                        <a href="{{ route('admin.application-forms.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times"></i> {{ __('Сбросить') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Список заявок -->
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Список заявок') }}</h4>
                        <div class="card-header-action">
                            {{-- Временно отключено из-за проблем с маршрутами
                            <a href="{{ route('admin.application-forms-export') }}?{{ http_build_query(request()->all()) }}" 
                               class="btn btn-success">
                                <i class="fas fa-download"></i> {{ __('Экспорт CSV') }}
                            </a>
                            <a href="{{ route('admin.application-forms-statistics') }}" class="btn btn-info">
                                <i class="fas fa-chart-bar"></i> {{ __('Статистика') }}
                            </a>
                            --}}
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('ФИО') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Телефон') }}</th>
                                        <th>{{ __('Факультет') }}</th>
                                        <th>{{ __('Специализация') }}</th>
                                        <th>{{ __('Курс') }}</th>
                                        <th>{{ __('Место работы') }}</th>
                                        <th>{{ __('Страна/Город') }}</th>
                                        <th>{{ __('Статус') }}</th>
                                        <th>{{ __('Дата') }}</th>
                                        <th>{{ __('Действия') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($applications as $application)
                                        <tr>
                                            <td>{{ $application->id }}</td>
                                            <td>
                                                <strong>{{ $application->full_name }}</strong>
                                                @if($application->notes)
                                                    <i class="fas fa-comment text-info" title="{{ $application->notes }}"></i>
                                                @endif
                                            </td>
                                            <td>{{ $application->email }}</td>
                                            <td>{{ $application->phone }}</td>
                                            <td>{{ $application->faculty?->name_ru ?? '-' }}</td>
                                            <td>{{ $application->specialization?->name_ru ?? '-' }}</td>
                                            <td>{{ $application->course?->title ?? '-' }}</td>
                                            <td>{{ $application->workplace ?? '-' }}</td>
                                            <td>
                                                @if($application->country && $application->city)
                                                    {{ $application->country->name }}, {{ $application->city->name }}
                                                @elseif($application->country)
                                                    {{ $application->country->name }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $statusColors = [
                                                        'pending' => 'warning',
                                                        'approved' => 'success',
                                                        'rejected' => 'danger',
                                                        'completed' => 'info'
                                                    ];
                                                    $statusNames = [
                                                        'pending' => 'Ожидает',
                                                        'approved' => 'Одобрена',
                                                        'rejected' => 'Отклонена',
                                                        'completed' => 'Завершена'
                                                    ];
                                                @endphp
                                                <span class="badge badge-{{ $statusColors[$application->status] ?? 'secondary' }}">
                                                    {{ $statusNames[$application->status] ?? $application->status }}
                                                </span>
                                            </td>
                                            <td>{{ $application->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.application-forms.show', $application->id) }}" 
                                                       class="btn btn-sm btn-info" title="{{ __('Просмотр') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    
                                                    <a href="{{ route('admin.application-forms.edit', $application->id) }}" 
                                                       class="btn btn-sm btn-warning" title="{{ __('Редактировать') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    
                                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" 
                                                            data-toggle="dropdown" title="{{ __('Изменить статус') }}">
                                                        <i class="fas fa-cog"></i>
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
                                                    
                                                    <form action="{{ route('admin.application-forms.destroy', $application->id) }}" 
                                                          method="POST" style="display: inline;" 
                                                          onsubmit="return confirm('{{ __('Вы уверены, что хотите удалить эту заявку?') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="{{ __('Удалить') }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">{{ __('Заявки не найдены') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Пагинация -->
                        <div class="d-flex justify-content-center">
                            {{ $applications->appends(request()->query())->links() }}
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
    // Инициализация DataTable
    $('#table-1').DataTable({
        "pageLength": 25,
        "order": [[8, "desc"]], // Сортировка по дате создания
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Russian.json"
        }
    });

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
