<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q', '');
        $category = $request->input('category', '');

        $query = Product::withPrices();

        if ($q) {
            // search title and short description
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', '%' . $q . '%')
                    ->orWhere('short_description', 'like', '%' . $q . '%');
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        $results = $query->paginate(12)->appends($request->only('q', 'category'));

        $categories = Product::select('category')->distinct()->pluck('category');

        return view('pages.default.searchpage', compact('results', 'q', 'category', 'categories'));
    }
}
