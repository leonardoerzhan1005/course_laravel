<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    /**
     * Display the documents page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.pages.documents');
    }
} 