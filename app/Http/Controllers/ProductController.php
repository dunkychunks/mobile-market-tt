<?php

namespace App\Http\Controllers;

use App\Traits\PhpFlasher;

class ProductController extends Controller
{

    use PhpFlasher;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return true;
    }
}
