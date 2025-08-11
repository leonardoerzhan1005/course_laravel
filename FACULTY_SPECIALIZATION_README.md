# Система направлений и специализаций для LMS

## Описание

Система реализует связь между направлениями (факультетами) и специализациями курсов в Laravel LMS. Каждое направление может содержать множество специализаций, а каждый курс может быть связан с несколькими специализациями.

## Структура базы данных

### Таблица `faculties` (направления)
- `id` - UUID первичный ключ
- `name_ru` - Название на русском языке
- `name_kz` - Название на казахском языке  
- `name_en` - Название на английском языке
- `sort_order` - Порядок сортировки
- `timestamps` - Временные метки

### Таблица `specializations` (специализации)
- `id` - UUID первичный ключ
- `faculty_id` - Внешний ключ на направление
- `name_ru` - Название на русском языке
- `name_kz` - Название на казахском языке
- `name_en` - Название на английском языке
- `is_active` - Активна ли специализация
- `sort_order` - Порядок сортировки
- `timestamps` - Временные метки

### Таблица `course_specialization` (связь курсов и специализаций)
- `id` - Автоинкрементный первичный ключ
- `course_id` - UUID курса
- `specialization_id` - UUID специализации
- `timestamps` - Временные метки

## Модели

### Faculty (Направление)
```php
// Связи
public function specializations(): HasMany
public function courses(): HasMany

// Аксессоры
public function getNameAttribute(): string

// Скоупы
public function scopeActive($query)
```

### Specialization (Специализация)
```php
// Связи
public function faculty(): BelongsTo
public function courses(): BelongsToMany
public function applications(): HasMany

// Аксессоры
public function getNameAttribute(): string

// Скоупы
public function scopeActive($query)
public function scopeByFaculty($query, $facultyId)
```

### Course (Курс)
```php
// Связи
public function faculty(): BelongsTo
public function specializations(): BelongsToMany
```

## Контроллеры

### FacultyController
- `index()` - Список всех направлений
- `create()` - Форма создания направления
- `store()` - Сохранение направления
- `show()` - Просмотр направления с специализациями
- `edit()` - Форма редактирования
- `update()` - Обновление направления
- `destroy()` - Удаление направления
- `getSpecializations()` - API для получения специализаций направления

### SpecializationController
- `index()` - Список всех специализаций
- `create()` - Форма создания специализации
- `store()` - Сохранение специализации
- `show()` - Просмотр специализации
- `edit()` - Форма редактирования
- `update()` - Обновление специализации
- `destroy()` - Удаление специализации
- `getByFaculty()` - API для получения специализаций по направлению
- `toggleStatus()` - Переключение статуса активности

## API Endpoints

### Получение специализаций по направлению
```
GET /admin/faculties/{faculty}/specializations
```

### Получение специализаций по ID направления
```
GET /admin/specializations-by-faculty/{facultyId}
```

## JavaScript API

### Инициализация
```javascript
// Автоматическая инициализация при загрузке страницы
// Или ручная инициализация
const manager = new FacultySpecializationManager();
```

### HTML разметка
```html
<!-- Селект направления -->
<select class="faculty-select" name="faculty_id">
    <option value="">Выберите направление</option>
    <!-- Опции загружаются динамически -->
</select>

<!-- Селект специализации -->
<select class="specialization-select" name="specialization_id">
    <option value="">Сначала выберите направление</option>
</select>
```

### Для множественных селектов
```html
<div data-specialization-container>
    <select data-faculty-select name="faculty_id[]">
        <option value="">Выберите направление</option>
    </select>
    
    <select data-specialization-select name="specialization_id[]">
        <option value="">Сначала выберите направление</option>
    </select>
</div>
```

## Сидеры

### FacultySeeder
Создает 4 основных направления:
- Биология
- География  
- Механика-Математика
- Физика

### SpecializationSeeder
Создает специализации для каждого направления на основе документа `task.md`.

## Использование

### 1. Запуск миграций
```bash
php artisan migrate
```

### 2. Запуск сидеров
```bash
php artisan db:seed --class=FacultySeeder
php artisan db:seed --class=SpecializationSeeder
```

### 3. Подключение JavaScript
```html
<script src="/js/faculty-specialization.js"></script>
```

### 4. Создание форм
```html
<form>
    <div class="form-group">
        <label>Направление</label>
        <select class="faculty-select" name="faculty_id" required>
            <option value="">Выберите направление</option>
            @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label>Специализация</label>
        <select class="specialization-select" name="specialization_id" required>
            <option value="">Сначала выберите направление</option>
        </select>
    </div>
</form>
```

## Особенности

1. **Многоязычность** - поддержка русского, казахского и английского языков
2. **Валидация** - проверка связей перед удалением
3. **API** - RESTful endpoints для AJAX запросов
4. **JavaScript** - автоматическое обновление специализаций при выборе направления
5. **Сортировка** - поддержка порядка отображения
6. **Активность** - возможность деактивировать специализации

## Безопасность

- Все маршруты защищены middleware `auth:admin`
- Валидация входных данных
- Проверка связей перед удалением
- Использование UUID для идентификаторов
