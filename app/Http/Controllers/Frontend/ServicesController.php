<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display the services page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.pages.services');
    }
} 