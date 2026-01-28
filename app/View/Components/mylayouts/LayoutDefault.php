<?php

namespace App\View\Components\mylayouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LayoutDefault extends Component
{
    public string $store;
    public string $title;
    public bool $hideBanner;
    /**
     * Create a new component instance.
     */
    public function __construct($store = null, $title = 'Store', $hideBanner = false)
    {
        $this->store = $store ?? config('app.store_name', 'eCommerce');
        $this->title = $title;
        $this->hideBanner = $hideBanner;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mylayouts.layout-default');
    }
}
