<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Traits\PhpFlasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    //Add flasher here
    use PhpFlasher;

    /**
     * Display a listing of the resource.
     * This index function shows the tiems a user added to the cart
     */
    public function index()
    {
        // Checks to see if user is authenticated or logged in and which group they belong to eg vip
        $group_ids = Auth::check() ? Auth::user()->getGroups() : [1];
// Gets the user who is logged in and stores it in a variable
        $user = Auth::user();
// Gets all the products a user added to the cart
        $cart_data = $user->products()->withPrices()->get();
// Gets the subtotal of items in the cart before tax or discounts or any other deductions
        $cart_data->calculateSubtotal();
//
        return view('pages.default.cartpage', compact('cart_data'));
    }

    /**
     * Responsible for adding items to the cart.
     *
     */
    public function store(Request $request)
    {
        //Checks if user id and product id are in the db. If exists will update quantity if not will create a new record
        Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            ['quantity' => DB::raw('quantity + ' . (int) $request->quantity), 'updated_at' => now()]
        );

        $this->flashSuccess('Item added to cart');

        // stay on the current page so the user can keep browsing
        return redirect()->back();
    }

    /**
     * Adds a single item from the shop listing page.
     */
    public function addToCartFromStore(Request $request)
    {
        Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->id],
            ['quantity' => DB::raw('quantity + 1'), 'updated_at' => now()]
        );

        $this->flashSuccess('Item added to cart');

        return redirect()->back();
    }


    /**
     * Update the quantity of an existing cart item.
     * Removes the item if quantity drops to zero.
     */
    public function update(Request $request, string $id)
    {
        $item = Cart::findOrFail($id);

        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $qty = max(0, (int) $request->input('quantity', 1));

        if ($qty === 0) {
            $item->delete();
            $this->flashInfo('Item removed from cart.');
        } else {
            $item->update(['quantity' => $qty]);
        }

        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::destroy($id);

        $this->flashError('Product removed from cart.');

        return redirect()->route('cart.index');
    }
}
