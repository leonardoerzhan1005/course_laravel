@extends('admin.master_layout')
@section('title')
    <title>{{ __('Преподаваемые предметы') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Преподаваемые предметы') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Преподаваемые предметы') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Список предметов') }}</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.teaching-subjects.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> {{ __('Добавить предмет') }}
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
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>{{ __('ID') }}</th>
                                                <th>{{ __('Название (РУС)') }}</th>
                                                <th>{{ __('Название (EN)') }}</th>
                                                <th>{{ __('Название (KZ)') }}</th>
                                                <th>{{ __('Категория') }}</th>
                                                <th>{{ __('Статус') }}</th>
                                                <th>{{ __('Порядок') }}</th>
                                                <th>{{ __('Действия') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subjects as $subject)
                                                <tr>
                                                    <td>{{ $subject->id }}</td>
                                                    <td>{{ $subject->name_ru }}</td>
                                                    <td>{{ $subject->name_en ?? '-' }}</td>
                                                    <td>{{ $subject->name_kz ?? '-' }}</td>
                                                    <td>
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
                                                        <span class="badge badge-info">{{ $categories[$subject->category] ?? $subject->category }}</span>
                                                    </td>
                                                    <td>
                                                        @if($subject->is_active)
                                                            <span class="badge badge-success">{{ __('Активен') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Неактивен') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $subject->sort_order }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.teaching-subjects.edit', $subject->id) }}" 
                                                               class="btn btn-sm btn-info" title="{{ __('Редактировать') }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            
                                                            <form action="{{ route('admin.teaching-subjects.toggle-status', $subject->id) }}" 
                                                                  method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-sm btn-warning" 
                                                                        title="{{ $subject->is_active ? 'Деактивировать' : 'Активировать' }}">
                                                                    <i class="fas fa-{{ $subject->is_active ? 'eye-slash' : 'eye' }}"></i>
                                                                </button>
                                                            </form>
                                                            
                                                            <form action="{{ route('admin.teaching-subjects.destroy', $subject->id) }}" 
                                                                  method="POST" style="display: inline;" 
                                                                  onsubmit="return confirm('{{ __('Вы уверены, что хотите удалить этот предмет?') }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ __('Удалить') }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
        $('#table-1').DataTable({
            "pageLength": 25,
            "order": [[6, "asc"], [1, "asc"]], // Сортировка по порядку, затем по названию
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Russian.json"
            }
        });
    });
</script>
@endpush
