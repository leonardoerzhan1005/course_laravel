@extends('admin.master_layout')

@section('title', __('Управление специализациями'))

@section('admin-content')
<div class="main-content">
    <div class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ __('Специализации') }}</h4>
                        <a href="{{ route('admin.specializations.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> {{ __('Добавить специализацию') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
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

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">{{ __('№') }}</th>
                                    <th width="20%">{{ __('Название (RU)') }}</th>
                                    <th width="20%">{{ __('Название (KZ)') }}</th>
                                    <th width="20%">{{ __('Название (EN)') }}</th>
                                    <th width="15%">{{ __('Направление') }}</th>
                                    <th width="10%">{{ __('Статус') }}</th>
                                    <th width="10%">{{ __('Порядок') }}</th>
                                    <th width="10%">{{ __('Действия') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($specializations as $index => $specialization)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $specialization->name_ru }}</td>
                                        <td>{{ $specialization->name_kz ?? '-' }}</td>
                                        <td>{{ $specialization->name_en ?? '-' }}</td>
                                        <td>
                                            @if($specialization->faculty)
                                                <a href="{{ route('admin.faculties.show', $specialization->faculty) }}" 
                                                   class="text-decoration-none">
                                                    {{ $specialization->faculty->name }}
                                                </a>
                                            @else
                                                <span class="text-muted">{{ __('Не указано') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $specialization->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $specialization->is_active ? __('Активна') : __('Неактивна') }}
                                            </span>
                                        </td>
                                        <td>{{ $specialization->sort_order }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.specializations.show', $specialization) }}" 
                                                   class="btn btn-sm btn-info" title="{{ __('Просмотр') }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.specializations.edit', $specialization) }}" 
                                                   class="btn btn-sm btn-warning" title="{{ __('Редактировать') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.specializations.toggle-status', $specialization) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm {{ $specialization->is_active ? 'btn-warning' : 'btn-success' }}" 
                                                            title="{{ $specialization->is_active ? __('Деактивировать') : __('Активировать') }}">
                                                        <i class="fas {{ $specialization->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.specializations.destroy', $specialization) }}" 
                                                      method="POST" class="d-inline" 
                                                      onsubmit="return confirm('{{ __('Вы уверены, что хотите удалить эту специализацию?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            title="{{ __('Удалить') }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">{{ __('Специализации не найдены') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
