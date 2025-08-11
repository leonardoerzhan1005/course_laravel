<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationForm;
use App\Models\Faculty;
use App\Models\Specialization;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApplicationFormController extends Controller
{
    /**
     * Показать список всех заявок
     */
    public function index(Request $request)
    {
        $query = ApplicationForm::with(['faculty', 'specialization', 'course'])
            ->orderBy('created_at', 'desc');

        // Фильтрация по статусу
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Фильтрация по факультету
        if ($request->filled('faculty_id')) {
            $query->where('faculty_id', $request->faculty_id);
        }

        // Фильтрация по специализации
        if ($request->filled('specialization_id')) {
            $query->where('specialty_id', $request->specialization_id);
        }

        // Поиск по имени или email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(20);
        $faculties = Faculty::orderBy('sort_order')->get();
        $specializations = Specialization::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.application-forms.index', compact('applications', 'faculties', 'specializations'));
    }

    /**
     * Показать детали заявки
     */
    public function show($id)
    {
        $application = ApplicationForm::with(['faculty', 'specialization', 'course'])->findOrFail($id);
        
        return view('admin.application-forms.show', compact('application'));
    }

    /**
     * Показать форму редактирования заявки
     */
    public function edit($id)
    {
        $application = ApplicationForm::findOrFail($id);
        $faculties = Faculty::orderBy('sort_order')->get();
        $specializations = Specialization::where('is_active', true)->orderBy('sort_order')->get();
        $courses = Course::where('status', 'active')->where('is_approved', 'approved')->orderBy('title')->get();
        $countries = \Modules\Location\app\Models\Country::orderBy('name')->get();
        $cities = $application->country_id ? \Modules\Location\app\Models\City::where('state_id', $application->country_id)->orderBy('name')->get() : collect();

        return view('admin.application-forms.edit', compact('application', 'faculties', 'specializations', 'courses', 'countries', 'cities'));
    }

    /**
     * Обновить заявку
     */
    public function update(Request $request, $id)
    {
        $application = ApplicationForm::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'workplace' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'institution_category' => 'required|string|max:50',
            'faculty_id' => 'required|exists:faculties,id',
            'specialty_id' => 'required|exists:specializations,id',
            'course_id' => 'nullable|exists:courses,id',
            'teaching_subjects' => 'nullable|array',
            'teaching_subjects.*' => 'string',
            'other_subjects' => 'nullable|string|max:500',
            'not_teaching' => 'nullable|boolean',
            'status' => 'required|in:pending,approved,rejected,completed',
            'notes' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'workplace' => $request->workplace,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'institution_category' => $request->institution_category,
            'faculty_id' => $request->faculty_id,
            'specialty_id' => $request->specialty_id,
            'course_id' => $request->course_id,
            'teaching_subjects' => $request->not_teaching ? [] : array_merge(
                $request->teaching_subjects ?? [],
                $request->other_subjects ? [$request->other_subjects] : []
            ),
            'not_teaching' => $request->not_teaching ?? false,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        Log::info('Application form updated by admin', [
            'application_id' => $application->id,
            'admin_id' => auth('admin')->id(),
            'status' => $request->status
        ]);

        return redirect()->route('admin.application-forms.index')
            ->with('success', 'Заявка успешно обновлена');
    }

    /**
     * Изменить статус заявки
     */
    public function updateStatus(Request $request, $id)
    {
        $application = ApplicationForm::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed'
        ]);

        $oldStatus = $application->status;
        $application->update(['status' => $request->status]);

        Log::info('Application status changed', [
            'application_id' => $application->id,
            'old_status' => $oldStatus,
            'new_status' => $request->status,
            'admin_id' => auth('admin')->id()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Статус заявки изменен',
            'new_status' => $request->status
        ]);
    }

    /**
     * Удалить заявку
     */
    public function destroy($id)
    {
        $application = ApplicationForm::findOrFail($id);
        $application->delete();

        Log::info('Application deleted by admin', [
            'application_id' => $id,
            'admin_id' => auth('admin')->id()
        ]);

        return redirect()->route('admin.application-forms.index')
            ->with('success', 'Заявка успешно удалена');
    }

    /**
     * Экспорт заявок в CSV
     */
    public function export(Request $request)
    {
        $query = ApplicationForm::with(['faculty', 'specialization', 'course'])
            ->orderBy('created_at', 'desc');

        // Применяем те же фильтры, что и в index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('faculty_id')) {
            $query->where('faculty_id', $request->faculty_id);
        }
        if ($request->filled('specialization_id')) {
            $query->where('specialty_id', $request->specialization_id);
        }

        $applications = $query->get();

        $filename = 'applications_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($applications) {
            $file = fopen('php://output', 'w');
            
            // Заголовки CSV
            fputcsv($file, [
                'ID', 'ФИО', 'Email', 'Телефон', 'Факультет', 'Специализация', 
                'Курс', 'Преподаваемые предметы', 'Статус', 'Дата создания', 'Заметки'
            ]);

            foreach ($applications as $app) {
                fputcsv($file, [
                    $app->id,
                    $app->full_name,
                    $app->email,
                    $app->phone,
                    $app->faculty?->name_ru ?? '',
                    $app->specialization?->name_ru ?? '',
                    $app->course?->title ?? '',
                    is_array($app->teaching_subjects) ? implode(', ', $app->teaching_subjects) : '',
                    $app->status,
                    $app->created_at->format('d.m.Y H:i'),
                    $app->notes ?? ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Получить статистику по заявкам
     */
    public function statistics()
    {
        $total = ApplicationForm::count();
        $pending = ApplicationForm::where('status', 'pending')->count();
        $approved = ApplicationForm::where('status', 'approved')->count();
        $rejected = ApplicationForm::where('status', 'rejected')->count();
        $completed = ApplicationForm::where('status', 'completed')->count();

        $facultyStats = ApplicationForm::selectRaw('faculty_id, COUNT(*) as count')
            ->with('faculty')
            ->groupBy('faculty_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        $monthlyStats = ApplicationForm::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        return view('admin.application-forms.statistics', compact(
            'total', 'pending', 'approved', 'rejected', 'completed',
            'facultyStats', 'monthlyStats'
        ));
    }
}
