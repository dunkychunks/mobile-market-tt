<?php

namespace App\Http\Controllers;

use App\Traits\PhpFlasher;

class HomeController extends Controller
{

    use PhpFlasher;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Description here
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.default.homepage');
    }
}
