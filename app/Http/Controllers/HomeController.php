<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\PhpFlasher;

class HomeController extends Controller
{

    use PhpFlasher;

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        // grab 8 products to feature on the home page
        $featured_products = Product::withPrices()->limit(8)->get();

        return view('home', compact('featured_products'));
    }
}
