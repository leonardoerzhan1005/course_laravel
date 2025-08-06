<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    /**
     * Display the certificates page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.pages.certificates');
    }

    /**
     * Search for certificates
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $certificateNumber = $request->input('certificate_number');
        $fullName = $request->input('full_name');

        // Здесь должна быть логика поиска сертификатов в базе данных
        // Пока возвращаем демо-данные
        $certificates = [];

        if ($certificateNumber || $fullName) {
            $certificates[] = [
                'id' => 1,
                'title' => 'Біліктілікті арттыру сертификаты',
                'holder' => 'Әлібек Серіков',
                'course' => 'Педагогтердің цифрлық құзыреттілігін дамыту',
                'number' => 'CERT-2025-001234',
                'issue_date' => '15.03.2025',
                'validity_period' => '5 жыл',
                'status' => 'Жарамды',
                'download_url' => '#',
                'view_url' => '#'
            ];
        }

        return response()->json([
            'success' => true,
            'certificates' => $certificates
        ]);
    }
} 