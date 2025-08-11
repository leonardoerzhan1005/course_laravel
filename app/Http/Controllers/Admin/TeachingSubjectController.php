<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeachingSubject;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TeachingSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $subjects = TeachingSubject::ordered()->get();
        $categories = TeachingSubject::distinct('category')->pluck('category');
        
        return view('admin.teaching-subjects.index', compact('subjects', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
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
        
        return view('admin.teaching-subjects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name_ru' => 'required|string|max:255|unique:teaching_subjects,name_ru',
            'name_en' => 'nullable|string|max:255',
            'name_kz' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ], [
            'name_ru.required' => 'Название на русском обязательно',
            'name_ru.unique' => 'Такой предмет уже существует',
            'category.required' => 'Категория обязательна'
        ]);

        TeachingSubject::create([
            'name_ru' => $request->name_ru,
            'name_en' => $request->name_en,
            'name_kz' => $request->name_kz,
            'category' => $request->category,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.teaching-subjects.index')
            ->with('success', 'Предмет успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeachingSubject $teachingSubject): View
    {
        return view('admin.teaching-subjects.show', compact('teachingSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeachingSubject $teachingSubject): View
    {
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
        
        return view('admin.teaching-subjects.edit', compact('teachingSubject', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeachingSubject $teachingSubject): RedirectResponse
    {
        $request->validate([
            'name_ru' => 'required|string|max:255|unique:teaching_subjects,name_ru,' . $teachingSubject->id,
            'name_en' => 'nullable|string|max:255',
            'name_kz' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        $teachingSubject->update([
            'name_ru' => $request->name_ru,
            'name_en' => $request->name_en,
            'name_kz' => $request->name_kz,
            'category' => $request->category,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.teaching-subjects.index')
            ->with('success', 'Предмет успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeachingSubject $teachingSubject): RedirectResponse
    {
        // Проверяем, используется ли предмет в заявках
        $usageCount = \App\Models\ApplicationForm::whereJsonContains('teaching_subjects', $teachingSubject->name_ru)->count();
        
        if ($usageCount > 0) {
            return redirect()->route('admin.teaching-subjects.index')
                ->with('error', 'Нельзя удалить предмет, который используется в заявках');
        }

        $teachingSubject->delete();

        return redirect()->route('admin.teaching-subjects.index')
            ->with('success', 'Предмет успешно удален');
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(TeachingSubject $teachingSubject): RedirectResponse
    {
        $teachingSubject->update(['is_active' => !$teachingSubject->is_active]);
        
        $status = $teachingSubject->is_active ? 'активирован' : 'деактивирован';
        return redirect()->route('admin.teaching-subjects.index')
            ->with('success', "Предмет {$status}");
    }
}
