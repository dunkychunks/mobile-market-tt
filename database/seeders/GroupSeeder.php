<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create pricing groups for each loyalty tier
        DB::table('groups')->insert([
            [
                'title' => 'Price Group - Tier 1',
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Price Group - Tier 2',
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Price Group - Tier 3',
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Subscribed',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
