@extends('admin.master_layout')

@section('title', __('Добавить направление курса'))

@section('admin-content')
<div class="main-content">
    <div class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ __('Добавить направление курса') }}</h4>
                        <a href="{{ route('admin.faculties.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('Назад к списку') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.faculties.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name_ru" class="form-label">{{ __('Название (RU)') }} *</label>
                                    <input type="text" class="form-control @error('name_ru') is-invalid @enderror" 
                                           id="name_ru" name="name_ru" value="{{ old('name_ru') }}" required>
                                    @error('name_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name_kz" class="form-label">{{ __('Название (KZ)') }}</label>
                                    <input type="text" class="form-control @error('name_kz') is-invalid @enderror" 
                                           id="name_kz" name="name_kz" value="{{ old('name_kz') }}">
                                    @error('name_kz')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name_en" class="form-label">{{ __('Название (EN)') }}</label>
                                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                           id="name_en" name="name_en" value="{{ old('name_en') }}">
                                    @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="sort_order" class="form-label">{{ __('Порядок сортировки') }}</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">{{ __('Чем меньше число, тем выше в списке') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('Сохранить') }}
                            </button>
                            <a href="{{ route('admin.faculties.index') }}" class="btn btn-secondary">
                                {{ __('Отмена') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
