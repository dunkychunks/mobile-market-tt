<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\PhpFlasher;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    use PhpFlasher;

    public function index($id){

        $group_ids = Auth::check() ? Auth::user()->getGroups() :[1];

        //get a product based on the id provided

        $data = Product::singleProduct($id)->get()->first();

        return view('pages.default.detailspage', compact('data'));
    }

}
