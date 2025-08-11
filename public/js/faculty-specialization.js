/**
 * Управление специализациями для направлений курсов
 */
class FacultySpecializationManager {
    constructor() {
        this.init();
    }

    init() {
        this.bindEvents();
        this.loadInitialData();
    }

    bindEvents() {
        // Обработчик изменения направления
        $(document).on('change', '#faculty_id', (e) => {
            this.onFacultyChange(e.target.value);
        });

        // Обработчик для форм создания/редактирования
        $(document).on('change', 'select[name="faculty_id"]', (e) => {
            this.onFacultyChange(e.target.value);
        });
    }

    loadInitialData() {
        const facultyId = $('#faculty_id').val();
        if (facultyId) {
            this.onFacultyChange(facultyId);
        }
    }

    onFacultyChange(facultyId) {
        if (!facultyId) {
            this.clearSpecializations();
            return;
        }

        this.loadSpecializations(facultyId);
    }

    loadSpecializations(facultyId) {
        const specializationSelect = $('#specialization_id');
        const loadingOption = '<option value="">{{ __("Загрузка специализаций..." }}</option>';
        
        // Показываем индикатор загрузки
        specializationSelect.html(loadingOption);
        specializationSelect.prop('disabled', true);

        // Загружаем специализации
        $.ajax({
            url: `/admin/specializations-by-faculty/${facultyId}`,
            method: 'GET',
            dataType: 'json',
            success: (data) => {
                this.populateSpecializations(data);
            },
            error: (xhr, status, error) => {
                console.error('Ошибка загрузки специализаций:', error);
                this.showError('Ошибка загрузки специализаций');
                this.clearSpecializations();
            }
        });
    }

    populateSpecializations(specializations) {
        const specializationSelect = $('#specialization_id');
        let options = '<option value="">{{ __("Выберите специализацию" }}</option>';
        
        if (specializations && specializations.length > 0) {
            specializations.forEach(specialization => {
                const selected = specialization.id == specializationSelect.data('selected') ? 'selected' : '';
                options += `<option value="${specialization.id}" ${selected}>${specialization.name}</option>`;
            });
        } else {
            options = '<option value="">{{ __("Специализации не найдены" }}</option>';
        }

        specializationSelect.html(options);
        specializationSelect.prop('disabled', false);
    }

    clearSpecializations() {
        const specializationSelect = $('#specialization_id');
        specializationSelect.html('<option value="">{{ __("Сначала выберите направление" }}</option>');
        specializationSelect.prop('disabled', true);
    }

    showError(message) {
        // Показываем ошибку пользователю
        if (typeof toastr !== 'undefined') {
            toastr.error(message);
        } else {
            alert(message);
        }
    }

    // Метод для обновления специализаций в других формах
    updateSpecializationsInForm(formSelector, facultyId) {
        const form = $(formSelector);
        const specializationSelect = form.find('select[name="specialization_id"]');
        
        if (specializationSelect.length && facultyId) {
            this.loadSpecializationsForForm(specializationSelect, facultyId);
        }
    }

    loadSpecializationsForForm(selectElement, facultyId) {
        selectElement.prop('disabled', true);
        selectElement.html('<option value="">{{ __("Загрузка..." }}</option>');

        $.ajax({
            url: `/admin/specializations-by-faculty/${facultyId}`,
            method: 'GET',
            dataType: 'json',
            success: (data) => {
                let options = '<option value="">{{ __("Выберите специализацию" }}</option>';
                
                if (data && data.length > 0) {
                    data.forEach(specialization => {
                        options += `<option value="${specialization.id}">${specialization.name}</option>`;
                    });
                } else {
                    options = '<option value="">{{ __("Специализации не найдены" }}</option>';
                }

                selectElement.html(options);
                selectElement.prop('disabled', false);
            },
            error: (xhr, status, error) => {
                console.error('Ошибка загрузки специализаций:', error);
                selectElement.html('<option value="">{{ __("Ошибка загрузки" }}</option>');
                selectElement.prop('disabled', false);
            }
        });
    }
}

// Инициализация при загрузке страницы
$(document).ready(function() {
    new FacultySpecializationManager();
});

// Экспорт для использования в других модулях
if (typeof module !== 'undefined' && module.exports) {
    module.exports = FacultySpecializationManager;
}
