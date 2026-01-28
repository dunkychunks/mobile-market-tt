<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class ProductCollectionHelper extends Collection
{
    private $subtotal = 0;
    private $total = 0;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function calculateSubtotal()
    {
        $product_data = $this->all();
        foreach ($product_data as $data) {
            $this->subtotal += $data->getCartQuantityPrice();
        }
        $this->total = $this->subtotal;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function calculateTotal()
    {
        return $this->total = $this->subtotal;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getTotal()
    {
        return $this->total;
    }
}
