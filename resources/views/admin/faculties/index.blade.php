@extends('admin.master_layout')

@section('title', __('Управление направлениями курсов'))

@section('admin-content')
<div class="main-content">
    <div class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ __('Направления курсов') }}</h4>
                        <a href="{{ route('admin.faculties.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> {{ __('Добавить направление') }}
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
                                    <th width="10%">{{ __('Порядок') }}</th>
                                    <th width="15%">{{ __('Специализации') }}</th>
                                    <th width="10%">{{ __('Действия') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faculties as $index => $faculty)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $faculty->name_ru }}</td>
                                        <td>{{ $faculty->name_kz ?? '-' }}</td>
                                        <td>{{ $faculty->name_en ?? '-' }}</td>
                                        <td>{{ $faculty->sort_order }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $faculty->specializations->count() }}</span>
                                            <a href="{{ route('admin.faculties.specializations', $faculty) }}" 
                                               class="btn btn-sm btn-outline-primary ms-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.faculties.show', $faculty) }}" 
                                                   class="btn btn-sm btn-info" title="{{ __('Просмотр') }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.faculties.edit', $faculty) }}" 
                                                   class="btn btn-sm btn-warning" title="{{ __('Редактировать') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.faculties.destroy', $faculty) }}" 
                                                      method="POST" class="d-inline" 
                                                      onsubmit="return confirm('{{ __('Вы уверены, что хотите удалить это направление?') }}')">
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
                                        <td colspan="7" class="text-center">{{ __('Направления не найдены') }}</td>
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
