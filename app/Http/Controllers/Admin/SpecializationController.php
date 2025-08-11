<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specializations = Specialization::with('faculty')->orderBy('faculty_id')->orderBy('sort_order')->get();
        return view('admin.specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::orderBy('sort_order')->get();
        return view('admin.specializations.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Логируем входящие данные
        \Log::info('Specialization store request data:', $request->all());
        \Log::info('is_active value:', ['raw' => $request->input('is_active'), 'type' => gettype($request->input('is_active'))]);
        \Log::info('has is_active:', ['has' => $request->has('is_active')]);

        $validator = Validator::make($request->all(), [
            'faculty_id' => 'required|uuid|exists:faculties,id',
            'name_ru' => 'required|string|max:255',
            'name_kz' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed:', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $isActive = $request->has('is_active');
        \Log::info('Processed is_active:', ['value' => $isActive, 'type' => gettype($isActive)]);

        Specialization::create([
            'id' => Str::uuid(),
            'faculty_id' => $request->faculty_id,
            'name_ru' => $request->name_ru,
            'name_kz' => $request->name_kz,
            'name_en' => $request->name_en,
            'is_active' => $isActive,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.specializations.index')->with('success', 'Специализация успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialization $specialization)
    {
        $specialization->load(['faculty', 'courses']);
        return view('admin.specializations.show', compact('specialization'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialization $specialization)
    {
        $faculties = Faculty::orderBy('sort_order')->get();
        return view('admin.specializations.edit', compact('specialization', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialization $specialization)
    {
        // Логируем входящие данные
        \Log::info('Specialization update request data:', $request->all());
        \Log::info('is_active value:', ['raw' => $request->input('is_active'), 'type' => gettype($request->input('is_active'))]);
        \Log::info('has is_active:', ['has' => $request->has('is_active')]);

        $validator = Validator::make($request->all(), [
            'faculty_id' => 'required|uuid|exists:faculties,id',
            'name_ru' => 'required|string|max:255',
            'name_kz' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed:', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $isActive = $request->has('is_active');
        \Log::info('Processed is_active:', ['value' => $isActive, 'type' => gettype($isActive)]);

        $specialization->update([
            'faculty_id' => $request->faculty_id,
            'name_ru' => $request->name_ru,
            'name_kz' => $request->name_kz,
            'name_en' => $request->name_en,
            'is_active' => $isActive,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.specializations.index')->with('success', 'Специализация успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialization $specialization)
    {
        // Проверяем, есть ли связанные курсы
        if ($specialization->courses()->count() > 0) {
            return redirect()->route('admin.specializations.index')->with('error', 'Нельзя удалить специализацию, у которой есть курсы');
        }

        $specialization->delete();
        return redirect()->route('admin.specializations.index')->with('success', 'Специализация успешно удалена');
    }

    /**
     * Get specializations by faculty (API endpoint)
     */
    public function getByFaculty($facultyId)
    {
        $specializations = Specialization::where('faculty_id', $facultyId)
            ->active()
            ->orderBy('sort_order')
            ->get();
        
        return response()->json($specializations);
    }

    /**
     * Toggle specialization status
     */
    public function toggleStatus(Specialization $specialization)
    {
        $specialization->update(['is_active' => !$specialization->is_active]);
        
        return redirect()->route('admin.specializations.index')->with('success', 
            'Статус специализации успешно изменен');
    }
}
