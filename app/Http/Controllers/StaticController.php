<?php

namespace App\Http\Controllers;

class StaticController extends Controller
{
    public function contact()
    {
        return view('pages.static.contact');
    }

    public function about()
    {
        return view('pages.static.about');
    }

    public function privacy()
    {
        return view('pages.static.privacy');
    }

    public function terms()
    {
        return view('pages.static.terms');
    }
}
