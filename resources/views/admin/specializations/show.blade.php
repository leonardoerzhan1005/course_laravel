@extends('admin.master_layout')

@section('title', __('Просмотр специализации'))

@section('admin-content')
<div class="main-content">
    <div class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ __('Специализация') }}</h4>
                        <div>
                            <a href="{{ route('admin.specializations.edit', $specialization) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> {{ __('Редактировать') }}
                            </a>
                            <a href="{{ route('admin.specializations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> {{ __('Назад к списку') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">{{ __('Название (RU):') }}</th>
                                    <td>{{ $specialization->name_ru }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Название (KZ):') }}</th>
                                    <td>{{ $specialization->name_kz ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Название (EN):') }}</th>
                                    <td>{{ $specialization->name_en ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Направление:') }}</th>
                                    <td>
                                        <a href="{{ route('admin.faculties.show', $specialization->faculty) }}" 
                                           class="text-decoration-none">
                                            {{ $specialization->faculty->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Статус:') }}</th>
                                    <td>
                                        <span class="badge {{ $specialization->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $specialization->is_active ? __('Активна') : __('Неактивна') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Порядок сортировки:') }}</th>
                                    <td>{{ $specialization->sort_order }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата создания:') }}</th>
                                    <td>{{ $specialization->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата обновления:') }}</th>
                                    <td>{{ $specialization->updated_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('Связанные курсы') }}</h5>
                                </div>
                                <div class="card-body">
                                    @if($specialization->courses->count() > 0)
                                        <div class="list-group">
                                            @foreach($specialization->courses as $course)
                                                <div class="list-group-item">
                                                    <strong>{{ $course->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ __('Инструктор:') }} {{ $course->instructor->name ?? 'Не указан' }}</small>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">{{ __('Связанные курсы не найдены') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
