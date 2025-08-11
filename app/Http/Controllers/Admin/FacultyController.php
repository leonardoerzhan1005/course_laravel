<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::withCount('specializations')->orderBy('sort_order')->get();
        return view('admin.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ru' => 'required|string|max:255',
            'name_kz' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Faculty::create([
            'id' => Str::uuid(),
            'name_ru' => $request->name_ru,
            'name_kz' => $request->name_kz,
            'name_en' => $request->name_en,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.faculties.index')->with('success', 'Направление курса успешно создано');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        $faculty->load(['specializations' => function($query) {
            $query->orderBy('sort_order');
        }]);
        return view('admin.faculties.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('admin.faculties.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $validator = Validator::make($request->all(), [
            'name_ru' => 'required|string|max:255',
            'name_kz' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $faculty->update([
            'name_ru' => $request->name_ru,
            'name_kz' => $request->name_kz,
            'name_en' => $request->name_en,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.faculties.index')->with('success', 'Направление курса успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        // Проверяем, есть ли связанные специализации
        if ($faculty->specializations()->count() > 0) {
            return redirect()->route('admin.faculties.index')->with('error', 'Нельзя удалить направление, у которого есть специализации');
        }

        $faculty->delete();
        return redirect()->route('admin.faculties.index')->with('success', 'Направление курса успешно удалено');
    }

    /**
     * Get specializations for a specific faculty
     */
    public function getSpecializations(Faculty $faculty)
    {
        $specializations = $faculty->specializations()->orderBy('sort_order')->get();
        return view('admin.faculties.specializations', compact('faculty', 'specializations'));
    }
}
