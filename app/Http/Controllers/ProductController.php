<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\PhpFlasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    use PhpFlasher;

    /**
     * Display a listing of the resource.
     * Supports optional ?category= filter from the sidebar.
     */
    public function index(Request $request)
    {
        $group_ids = Auth::check() ? Auth::user()->getGroups() : [1];

        $active_category = $request->input('category', '');

        // apply category filter when one is selected from the sidebar
        $query = Product::withPrices($group_ids);
        if ($active_category) {
            $query->where('category', $active_category);
        }

        $product_data = $query->paginate(6)->appends($request->only('category'));

        // category counts for the sidebar
        $categories = Product::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category');

        return view('pages.default.productspage', compact('product_data', 'categories', 'active_category'));
    }
}
