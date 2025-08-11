@extends('admin.master_layout')

@section('title', __('Просмотр направления курса'))

@section('admin-content')
<div class="main-content">
    <div class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ __('Направление курса') }}</h4>
                        <div>
                            <a href="{{ route('admin.faculties.edit', $faculty) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> {{ __('Редактировать') }}
                            </a>
                            <a href="{{ route('admin.faculties.index') }}" class="btn btn-secondary">
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
                                    <td>{{ $faculty->name_ru }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Название (KZ):') }}</th>
                                    <td>{{ $faculty->name_kz ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Название (EN):') }}</th>
                                    <td>{{ $faculty->name_en ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Порядок сортировки:') }}</th>
                                    <td>{{ $faculty->sort_order }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата создания:') }}</th>
                                    <td>{{ $faculty->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Дата обновления:') }}</th>
                                    <td>{{ $faculty->updated_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('Специализации') }}</h5>
                                </div>
                                <div class="card-body">
                                    @if($faculty->specializations->count() > 0)
                                        <div class="list-group">
                                            @foreach($faculty->specializations as $specialization)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $specialization->name }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ __('Порядок:') }} {{ $specialization->sort_order }}</small>
                                                    </div>
                                                    <span class="badge {{ $specialization->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $specialization->is_active ? __('Активна') : __('Неактивна') }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">{{ __('Специализации не найдены') }}</p>
                                    @endif
                                    
                                    <div class="mt-3">
                                        <a href="{{ route('admin.specializations.create') }}?faculty_id={{ $faculty->id }}" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i> {{ __('Добавить специализацию') }}
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
</div>
@endsection
