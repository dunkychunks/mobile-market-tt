<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // NOTE: Change Shipping ID in .env file only
        DB::table('shipping')->insert([
            [
                'title' => 'Standard Shipping',
                'price' => 10,
                'days' => 3,
                'stripe_id' => env('SHIPPING_ID_1'),
                'display_order' => 5,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Express Shipping',
                'price' => 13,
                'days' => 1,
                'stripe_id' => env('SHIPPING_ID_2'),
                'display_order' => 6,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Free Express Shipping',
                'price' => 0,
                'days' => 1,
                'stripe_id' => env('SHIPPING_ID_3'),
                'display_order' => 1,
                'created_at' => Carbon::now(),
            ],
        ]);

        // Assign shipping to groups
        DB::table('shipping_options')->insert([
            [
                'group_id' => 1,
                'shipping_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group_id' => 1,
                'shipping_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'group_id' => 4,
                'shipping_id' => 3,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
