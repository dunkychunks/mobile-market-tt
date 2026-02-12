<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\PhpFlasher;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    use PhpFlasher;

    /**
     * Display a listing of the resource.
     * This function pulls products from the Products table
     * The information is then sent to the products page to be displayed
     */
    public function index()
    {
        //Check to see if user is logged in and which groups they belong to e.g. Amazon prime member discounts

        $group_ids = Auth::check() ? Auth::user()->getGroups() : [1];

        //retrieves products from the Products table

        //$product_data = Product::withPrices()->get();
        $product_data = Product::withPrices()->paginate(6);

        //pass data to the Products page to display

        return view('pages.default.productspage', compact('product_data'));
    }
}
