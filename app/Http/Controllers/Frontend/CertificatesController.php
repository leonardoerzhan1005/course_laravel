<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    /**
     * Показать страницу сертификатов
     */
    public function index()
    {
        return view('frontend.pages.certificates');
    }

    /**
     * Поиск сертификата
     */
    public function search(Request $request)
    {
        $request->validate([
            'certificate_number' => 'nullable|string|max:50',
            'full_name' => 'nullable|string|max:255',
        ]);

        // Здесь будет логика поиска сертификата
        // Пока возвращаем пустой результат
        return response()->json([
            'success' => false,
            'message' => 'Сертификат не найден',
            'data' => null
        ]);
    }
} 