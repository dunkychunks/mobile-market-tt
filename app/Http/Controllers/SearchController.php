<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
 * Basic Eloquent search implementation using LIKE queries.
 *
 * Architecture note: the search logic is intentionally contained in a single
 * controller method so it can be replaced by an external search engine in future
 * (e.g. Laravel Scout + Meilisearch). The indexed fields would be: title,
 * short_description, full_description, category, classification, status, and
 * the price computed by Product::withPrices(). The view (searchpage.blade.php)
 * and URL structure (/search?q=&category=) are engine-agnostic and will not
 * need to change when the backend is swapped.
 */
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q', '');
        $category = $request->input('category', '');

        $group_ids = Auth::check() ? Auth::user()->getGroups() : [1];
        $query = Product::withPrices($group_ids);

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
