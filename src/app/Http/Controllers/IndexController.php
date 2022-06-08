<?php

namespace App\Http\Controllers;

use App\Studio;

class IndexController extends Controller
{
    public function index()
    {
        $studios = Studio::all()->sortBy('order');
        return view('main_view.welcome.welcome', compact('studios'));
    }
}
