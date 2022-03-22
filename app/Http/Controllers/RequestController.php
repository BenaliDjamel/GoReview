<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RequestController extends Controller
{
   
    public function create(Request $request) {
        return Inertia::render('Request/CreateRequest');
    }
}
