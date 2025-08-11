<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ApplicationForm;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ApplicationFormController extends Controller
{
    public function index(): View
    {
        try {
            // Получаем страны
            $countries = \Modules\Location\app\Models\Country::select('id', 'name')->get();
            
            // Получаем факультеты (направления) с переводами
            $faculties = Faculty::where('id', '!=', '0')
                               ->orderBy('sort_order')
                               ->get();
            
            // Получаем специализации с переводами
            $specializations = Specialization::where('is_active', 1)
                                           ->with('faculty')
                                           ->orderBy('sort_order')
                                           ->get();
            
            // Получаем языки курсов
            $courseLanguages = DB::table('education_languages')
                               ->select('code', 'name_ru as name')
                               ->get();
            
        } catch (\Exception $e) {
            Log::error('Error loading application form data: ' . $e->getMessage());
            
            // Если база данных недоступна, используем временные данные
            $countries = collect([
                (object)['id' => 1, 'name' => 'Россия'],
                (object)['id' => 2, 'name' => 'Казахстан'],
                (object)['id' => 3, 'name' => 'Беларусь'],
            ]);
            
            $faculties = collect([
                (object)['id' => 1, 'name_ru' => 'Информационные технологии'],
                (object)['id' => 2, 'name_ru' => 'Педагогика'],
                (object)['id' => 3, 'name_ru' => 'Медицина'],
            ]);
            
            $specializations = collect([
                (object)['id' => 1, 'name_ru' => 'Программирование', 'faculty_id' => 1],
                (object)['id' => 2, 'name_ru' => 'Сетевая безопасность', 'faculty_id' => 1],
                (object)['id' => 3, 'name_ru' => 'Математика', 'faculty_id' => 2],
                (object)['id' => 4, 'name_ru' => 'Физика', 'faculty_id' => 2],
            ]);
            
            $courseLanguages = collect([
                (object)['code' => 'ru', 'name' => 'Русский'],
                (object)['code' => 'en', 'name' => 'Английский'],
                (object)['code' => 'kk', 'name' => 'Казахский'],
            ]);
        }
        
        return view('frontend.application-form.index', compact('countries', 'faculties', 'specializations', 'courseLanguages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // Личные данные (кириллица)
            'last_name_cyrillic' => 'required|string|max:255|regex:/^[\p{Cyrillic}\s]+$/u',
            'first_name_cyrillic' => 'required|string|max:255|regex:/^[\p{Cyrillic}\s]+$/u',
            'middle_name_cyrillic' => 'required|string|max:255|regex:/^[\p{Cyrillic}\s]+$/u',
            
            // Личные данные (латиница)
            'last_name_latin' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'first_name_latin' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'middle_name_latin' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            
            // Гражданство
            'is_foreign_citizen' => 'required|boolean',
            
            // Контактная информация
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20|regex:/^\+7\s?\(\d{3}\)\s?\d{3}-\d{2}-\d{2}$/',
            
            // Образование и работа
            'faculty_id' => 'required|exists:faculties,id',
            'specialization_id' => 'required|exists:specializations,id',
            'workplace' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'institution_category' => 'required|string|max:255',
            'other_institution_type' => 'nullable|string|max:255|required_if:institution_category,other',
            'academic_degree' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'teaching_subjects' => 'nullable|array',
            'teaching_subjects.*' => 'string|max:255',
            'other_subjects' => 'nullable|string|max:500',
            'not_teaching' => 'nullable|boolean',
            
            // Курс и даты
            'course_id' => 'required|exists:courses,id',
            'course_language' => 'required|exists:education_languages,code',
            'seminar_start_date' => 'required|date|after:today',
            'seminar_end_date' => 'required|date|after:seminar_start_date',
        ], [
            'last_name_cyrillic.required' => 'Фамилия (кириллица) обязательна',
            'last_name_cyrillic.regex' => 'Фамилия должна содержать только кириллические символы',
            'first_name_cyrillic.required' => 'Имя (кириллица) обязательно',
            'first_name_cyrillic.regex' => 'Имя должно содержать только кириллические символы',
            'middle_name_cyrillic.required' => 'Отчество (кириллица) обязательно',
            'middle_name_cyrillic.regex' => 'Отчество должно содержать только кириллические символы',
            'last_name_latin.required' => 'Фамилия (латиница) обязательна',
            'last_name_latin.regex' => 'Фамилия должна содержать только латинские символы',
            'first_name_latin.required' => 'Имя (латиница) обязательно',
            'first_name_latin.regex' => 'Имя должно содержать только латинские символы',
            'middle_name_latin.required' => 'Отчество (латиница) обязательно',
            'middle_name_latin.regex' => 'Отчество должно содержать только латинские символы',
            'is_foreign_citizen.required' => 'Укажите гражданство',
            'email.required' => 'Email обязателен',
            'email.email' => 'Введите корректный email',
            'phone.required' => 'Телефон обязателен',
            'phone.regex' => 'Телефон должен быть в формате +7 (XXX) XXX-XX-XX',
            'faculty_id.required' => 'Направление курса обязательно',
            'faculty_id.exists' => 'Выбранное направление не существует',
            'specialization_id.required' => 'Специализация обязательна',
            'specialization_id.exists' => 'Выбранная специализация не существует',
            'workplace.required' => 'Место работы обязательно',
            'country_id.required' => 'Выберите страну',
            'city_id.required' => 'Выберите город',
            'institution_category.required' => 'Выберите категорию учреждения',
            'other_institution_type.required_if' => 'Укажите тип учреждения',
            'academic_degree.required' => 'Выберите ученую степень',
            'position.required' => 'Должность обязательна',
            'teaching_subjects.required' => 'Укажите преподаваемые предметы',
            'teaching_subjects.min' => 'Выберите хотя бы один предмет',
            'course_id.required' => 'Выберите курс',
            'course_language.required' => 'Выберите язык прохождения курса',
            'course_language.exists' => 'Выбранный язык курса не существует. Пожалуйста, выберите язык из списка.',
            'seminar_start_date.required' => 'Укажите дату начала семинара',
            'seminar_start_date.after' => 'Дата начала должна быть в будущем',
            'seminar_end_date.required' => 'Укажите дату окончания семинара',
            'seminar_end_date.after' => 'Дата окончания должна быть после даты начала',
        ]);

        try {
            DB::beginTransaction();

            // Логируем входящие данные для диагностики
            \Log::info('Application form data received:', [
                'faculty_id' => $request->faculty_id,
                'specialization_id' => $request->specialization_id,
                'course_id' => $request->course_id,
                'last_name_cyrillic' => $request->last_name_cyrillic,
                'first_name_cyrillic' => $request->first_name_cyrillic,
                'middle_name_cyrillic' => $request->middle_name_cyrillic,
                'full_name_calculated' => trim($request->last_name_cyrillic . ' ' . $request->first_name_cyrillic . ' ' . $request->middle_name_cyrillic),
                'all_data' => $request->all()
            ]);

            // Проверяем, не подавал ли уже пользователь заявку
            $existingApplication = ApplicationForm::where('email', $request->email)
                                                ->where('status', 'pending')
                                                ->first();
            
            if ($existingApplication) {
                return redirect()->back()->with('error', 'Вы уже подали заявку с этим email. Дождитесь ответа или свяжитесь с нами.');
            }

            // Получаем названия факультета и специализации для сохранения
            $faculty = Faculty::find($request->faculty_id);
            $specialization = Specialization::find($request->specialization_id);
            
            \Log::info('Found entities:', [
                'faculty' => $faculty ? $faculty->name_ru : 'NOT FOUND',
                'specialization' => $specialization ? $specialization->name_ru : 'NOT FOUND'
            ]);

            // Обработка преподаваемых предметов
            $teachingSubjects = [];
            if (!$request->has('not_teaching')) {
                if ($request->filled('teaching_subjects')) {
                    $teachingSubjects = $request->teaching_subjects;
                }
                if ($request->filled('other_subjects')) {
                    $otherSubjects = array_map('trim', explode(',', $request->other_subjects));
                    $teachingSubjects = array_merge($teachingSubjects, $otherSubjects);
                }
            }

            $application = ApplicationForm::create([
                'last_name_cyrillic' => trim($request->last_name_cyrillic),
                'first_name_cyrillic' => trim($request->first_name_cyrillic),
                'middle_name_cyrillic' => trim($request->middle_name_cyrillic),
                'last_name_latin' => trim($request->last_name_latin),
                'first_name_latin' => trim($request->first_name_latin),
                'middle_name_latin' => trim($request->middle_name_latin),
                'is_foreign_citizen' => $request->is_foreign_citizen,
                'email' => strtolower(trim($request->email)),
                'phone' => $request->phone,
                'full_name' => trim($request->last_name_cyrillic . ' ' . $request->first_name_cyrillic . ' ' . $request->middle_name_cyrillic),
                'faculty_id' => $request->faculty_id,
                'workplace' => trim($request->workplace),
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'institution_category' => $request->institution_category === 'other' ? $request->other_institution_type : $request->institution_category,
                'other_institution_type' => $request->institution_category === 'other' ? $request->other_institution_type : null,
                'academic_degree' => trim($request->academic_degree),
                'position' => trim($request->position),
                'teaching_subjects' => $teachingSubjects,
                'not_teaching' => $request->has('not_teaching'),
                'course_id' => $request->course_id,
                'specialty_id' => $specialization ? $specialization->id : null,
                'course_language' => $request->course_language,
                'seminar_start_date' => $request->seminar_start_date,
                'seminar_end_date' => $request->seminar_end_date,
                'status' => 'pending',
            ]);
            
            \Log::info('Application created successfully:', [
                'id' => $application->id,
                'full_name' => $application->full_name,
                'faculty_id' => $application->faculty_id,
                'specialty_id' => $application->specialty_id,
                'course_id' => $application->course_id
            ]);

            DB::commit();

            // Здесь можно добавить отправку уведомлений
            // event(new ApplicationSubmitted($application));

            return redirect()->back()->with('success', 'Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating application: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Произошла ошибка при отправке заявки. Попробуйте еще раз.');
        }
    }

    public function getCities(Request $request): JsonResponse
    {
        try {
            $cities = \Modules\Location\app\Models\City::where('state_id', $request->country_id)
                                                      ->select('id', 'name')
                                                      ->orderBy('name')
                                                      ->get();
            
            return response()->json($cities);
        } catch (\Exception $e) {
            Log::error('Error loading cities: ' . $e->getMessage());
            return response()->json(['error' => 'Ошибка загрузки городов'], 500);
        }
    }

    public function getSpecializationsByFaculty(Request $request): JsonResponse
    {
        try {
            $facultyId = $request->get('faculty_id');
            
            if (!$facultyId) {
                return response()->json(['error' => 'Faculty ID is required'], 400);
            }
            
            $specializations = Specialization::where('faculty_id', $facultyId)
                                           ->where('is_active', 1)
                                           ->orderBy('sort_order')
                                           ->get(['id', 'name_ru', 'name_en', 'name_kz']);
            
            return response()->json($specializations);
        } catch (\Exception $e) {
            Log::error('Error loading specializations: ' . $e->getMessage());
            return response()->json(['error' => 'Ошибка загрузки специализаций'], 500);
        }
    }

    public function getCoursesByFaculty(Request $request): JsonResponse
    {
        try {
            $facultyId = $request->get('faculty_id');
            
            if (!$facultyId) {
                return response()->json(['error' => 'Faculty ID is required'], 400);
            }
            
            // Получаем курсы через специализации факультета
            $courses = Course::where('status', 'active')
                           ->where('is_approved', 'approved')
                           ->whereHas('specialization', function($query) use ($facultyId) {
                               $query->where('faculty_id', $facultyId);
                           })
                           ->select('id', 'title')
                           ->orderBy('title')
                           ->get();
            
            return response()->json($courses);
        } catch (\Exception $e) {
            Log::error('Error loading courses: ' . $e->getMessage());
            return response()->json(['error' => 'Ошибка загрузки курсов'], 500);
        }
    }

    public function getCoursesBySpecialization(Request $request): JsonResponse
    {
        try {
            $specializationId = $request->get('specialization_id');
            
            if (!$specializationId) {
                return response()->json(['error' => 'Specialization ID is required'], 400);
            }
            
            // Получаем курсы для конкретной специализации
            $courses = Course::where('status', 'active')
                           ->where('is_approved', 'approved')
                           ->where('specialization_id', $specializationId)
                           ->select('id', 'title')
                           ->orderBy('title')
                           ->get();
            
            return response()->json($courses);
        } catch (\Exception $e) {
            Log::error('Error loading courses by specialization: ' . $e->getMessage());
            return response()->json(['error' => 'Ошибка загрузки курсов'], 500);
        }
    }
} 