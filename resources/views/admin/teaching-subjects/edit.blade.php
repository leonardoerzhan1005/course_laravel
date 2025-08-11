@extends('admin.master_layout')
@section('title')
    <title>{{ __('Редактировать предмет') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Редактировать предмет') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.teaching-subjects.index') }}">{{ __('Преподаваемые предметы') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Редактировать') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Предмет:') }} {{ $teachingSubject->name_ru }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.teaching-subjects.update', $teachingSubject->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name_ru">{{ __('Название (РУС)') }} *</label>
                                                <input type="text" id="name_ru" name="name_ru" 
                                                       class="form-control @error('name_ru') is-invalid @enderror" 
                                                       value="{{ old('name_ru', $teachingSubject->name_ru) }}" required>
                                                @error('name_ru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name_en">{{ __('Название (EN)') }}</label>
                                                <input type="text" id="name_en" name="name_en" 
                                                       class="form-control @error('name_en') is-invalid @enderror" 
                                                       value="{{ old('name_en', $teachingSubject->name_en) }}">
                                                @error('name_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name_kz">{{ __('Название (KZ)') }}</label>
                                                <input type="text" id="name_kz" name="name_kz" 
                                                       class="form-control @error('name_kz') is-invalid @enderror" 
                                                       value="{{ old('name_kz', $teachingSubject->name_kz) }}">
                                                @error('name_kz')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">{{ __('Категория') }} *</label>
                                                <select id="category" name="category" 
                                                        class="form-control @error('category') is-invalid @enderror" required>
                                                    <option value="">{{ __('Выберите категорию') }}</option>
                                                    @foreach($categories as $key => $name)
                                                        <option value="{{ $key }}" {{ old('category', $teachingSubject->category) == $key ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sort_order">{{ __('Порядок сортировки') }}</label>
                                                <input type="number" id="sort_order" name="sort_order" 
                                                       class="form-control @error('sort_order') is-invalid @enderror" 
                                                       value="{{ old('sort_order', $teachingSubject->sort_order) }}" min="0">
                                                @error('sort_order')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="form-text text-muted">{{ __('Меньшее число = выше в списке') }}</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                                           value="1" {{ old('is_active', $teachingSubject->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">
                                                        {{ __('Активен') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-save"></i> {{ __('Обновить') }}
                                        </button>
                                        <a href="{{ route('admin.teaching-subjects.index') }}" class="btn btn-secondary btn-lg ml-2">
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
