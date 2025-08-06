<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ApplicationForm;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ApplicationFormController extends Controller
{
    public function index(): View
    {
        try {
            // Получаем активные курсы
            $courses = Course::where('status', 'active')
                           ->where('is_approved', 'approved')
                           ->select('id', 'title')
                           ->get();
            
            // Получаем страны
            $countries = \Modules\Location\app\Models\Country::select('id', 'name')->get();
            
            // Получаем категории курсов с переводами
            $courseCategories = \Modules\Course\app\Models\CourseCategory::where('status', 1)
                                                                    ->with('translation')
                                                                    ->get();
            
            // Получаем уровни курсов с переводами
            $courseLevels = \Modules\Course\app\Models\CourseLevel::where('status', 1)
                                                               ->with('translation')
                                                               ->get();
            
            // Получаем языки курсов
            $courseLanguages = \Modules\Course\app\Models\CourseLanguage::where('status', 1)
                                                                     ->select('id', 'name')
                                                                     ->get();
            
        } catch (\Exception $e) {
            // Если база данных недоступна, используем временные данные
            $courses = collect([
                (object)['id' => 1, 'title' => 'Курс повышения квалификации 1'],
                (object)['id' => 2, 'title' => 'Курс повышения квалификации 2'],
                (object)['id' => 3, 'title' => 'Курс повышения квалификации 3'],
            ]);
            
            $countries = collect([
                (object)['id' => 1, 'name' => 'Россия'],
                (object)['id' => 2, 'name' => 'Казахстан'],
                (object)['id' => 3, 'name' => 'Беларусь'],
            ]);
            
            $courseCategories = collect([
                (object)['id' => 1, 'name' => 'Информационные технологии'],
                (object)['id' => 2, 'name' => 'Педагогика'],
                (object)['id' => 3, 'name' => 'Медицина'],
            ]);
            
            $courseLevels = collect([
                (object)['id' => 1, 'name' => 'Начальный'],
                (object)['id' => 2, 'name' => 'Средний'],
                (object)['id' => 3, 'name' => 'Продвинутый'],
            ]);
            
            $courseLanguages = collect([
                (object)['id' => 1, 'name' => 'Русский'],
                (object)['id' => 2, 'name' => 'Английский'],
                (object)['id' => 3, 'name' => 'Казахский'],
            ]);
        }
        
        return view('frontend.application-form.index', compact('courses', 'countries', 'courseCategories', 'courseLevels', 'courseLanguages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // Личные данные (кириллица)
            'last_name_cyrillic' => 'required|string|max:255',
            'first_name_cyrillic' => 'required|string|max:255',
            'middle_name_cyrillic' => 'required|string|max:255',
            
            // Личные данные (латиница)
            'last_name_latin' => 'required|string|max:255',
            'first_name_latin' => 'required|string|max:255',
            'middle_name_latin' => 'required|string|max:255',
            
            // Гражданство
            'is_foreign_citizen' => 'required|boolean',
            
            // Контактная информация
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            
            // Образование и работа
            'course_direction' => 'required|string|max:255',
            'workplace' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'institution_category' => 'required|string|max:255',
            'other_institution_type' => 'nullable|string|max:255',
            'academic_degree' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'teaching_subjects' => 'required|array',
            'teaching_subjects.*' => 'string|max:255',
            
            // Курс и даты
            'course_id' => 'required|exists:courses,id',
            'specialty_id' => 'required|exists:course_levels,id',
            'course_language' => 'required|exists:course_languages,id',
            'seminar_start_date' => 'required|date',
            'seminar_end_date' => 'required|date|after:seminar_start_date',
        ], [
            'last_name_cyrillic.required' => 'Фамилия (кириллица) обязательна',
            'first_name_cyrillic.required' => 'Имя (кириллица) обязательно',
            'middle_name_cyrillic.required' => 'Отчество (кириллица) обязательно',
            'last_name_latin.required' => 'Фамилия (латиница) обязательна',
            'first_name_latin.required' => 'Имя (латиница) обязательно',
            'middle_name_latin.required' => 'Отчество (латиница) обязательно',
            'is_foreign_citizen.required' => 'Укажите гражданство',
            'email.required' => 'Email обязателен',
            'email.email' => 'Введите корректный email',
            'phone.required' => 'Телефон обязателен',
            'course_direction.required' => 'Направление курса обязательно',
            'workplace.required' => 'Место работы обязательно',
            'country_id.required' => 'Выберите страну',
            'city_id.required' => 'Выберите город',
            'institution_category.required' => 'Выберите категорию учреждения',
            'academic_degree.required' => 'Выберите ученую степень',
            'position.required' => 'Должность обязательна',
            'teaching_subjects.required' => 'Укажите преподаваемые предметы',
            'course_id.required' => 'Выберите курс',
            'specialty_id.required' => 'Выберите уровень курса',
            'specialty_id.exists' => 'Выбранный уровень курса не существует',
            'course_language.required' => 'Выберите язык прохождения курса',
            'course_language.exists' => 'Выбранный язык курса не существует',
            'seminar_start_date.required' => 'Укажите дату начала семинара',
            'seminar_end_date.required' => 'Укажите дату окончания семинара',
            'seminar_end_date.after' => 'Дата окончания должна быть после даты начала',
        ]);

        try {
            DB::beginTransaction();

            $application = ApplicationForm::create([
                'last_name_cyrillic' => $request->last_name_cyrillic,
                'first_name_cyrillic' => $request->first_name_cyrillic,
                'middle_name_cyrillic' => $request->middle_name_cyrillic,
                'last_name_latin' => $request->last_name_latin,
                'first_name_latin' => $request->first_name_latin,
                'middle_name_latin' => $request->middle_name_latin,
                'is_foreign_citizen' => $request->is_foreign_citizen,
                'email' => $request->email,
                'phone' => $request->phone,
                'course_direction' => $request->course_direction,
                'workplace' => $request->workplace,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'institution_category' => $request->institution_category,
                'other_institution_type' => $request->other_institution_type,
                'academic_degree' => $request->academic_degree,
                'position' => $request->position,
                'teaching_subjects' => $request->teaching_subjects,
                'course_id' => $request->course_id,
                'specialty_id' => $request->specialty_id,
                'course_language' => $request->course_language,
                'seminar_start_date' => $request->seminar_start_date,
                'seminar_end_date' => $request->seminar_end_date,
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Произошла ошибка при отправке заявки. Попробуйте еще раз.');
        }
    }

    public function getCities(Request $request)
    {
        try {
            $cities = \Modules\Location\app\Models\City::where('state_id', $request->country_id)
                                                      ->select('id', 'name')
                                                      ->get();
        } catch (\Exception $e) {
            // Временные данные для тестирования
            $cities = collect([
                (object)['id' => 1, 'name' => 'Москва'],
                (object)['id' => 2, 'name' => 'Санкт-Петербург'],
                (object)['id' => 3, 'name' => 'Новосибирск'],
            ]);
        }
        return response()->json($cities);
    }

    public function getSpecialties(Request $request)
    {
        try {
            $levels = \Modules\Course\app\Models\CourseLevel::where('status', 1)
                                                         ->with('translation')
                                                         ->select('id', 'name')
                                                         ->get();
        } catch (\Exception $e) {
            $levels = collect([
                (object)['id' => 1, 'name' => 'Начальный'],
                (object)['id' => 2, 'name' => 'Средний'],
                (object)['id' => 3, 'name' => 'Продвинутый'],
            ]);
        }
        
        return response()->json($levels);
    }
} 