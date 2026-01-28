<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

    //Add flasher here

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return true;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return true;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addToCartFromStore(Request $request)
    {
        return true;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return true;
    }
}
