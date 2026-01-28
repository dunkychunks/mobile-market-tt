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
        // Create all groups available
        DB::table('groups')->insert([
            [
                'title' => 'tier 1',
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'tier 2',
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'tier 3',
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'subscribed',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
