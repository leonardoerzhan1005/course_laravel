<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Показать страницу услуг
     */
    public function index()
    {
        return view('frontend.pages.services');
    }
} 