<?php

namespace App\View\Components\core;

use App\Models\Cart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CartIcon extends Component
{
    public $cartNumber = 0;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->cartNumber = Cart::where('user_id', Auth::id())->sum('quantity');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.cart-icon');
    }
}
