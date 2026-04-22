<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tiers')->insert([
            [
                'title' => 'Tier 1',
                'spending_range' => 0,
                'group_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Tier 2',
                'spending_range' => 2000,
                'group_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Tier 3',
                'spending_range' => 3000,
                'group_id' => 3,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
