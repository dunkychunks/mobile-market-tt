<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class SafeReset extends Command
{
    protected $signature = 'db:safe-reset';
    protected $description = 'Refresh the database but keep all products';
    protected $fileName = 'products_data.json';

    public function handle()
    {
        // 1. Setup the Backup Directory
        $backupDir = base_path('backup');
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir);
        }
        $filePath = $backupDir . '/' . $this->fileName;

        // 2. Export Products
        $this->info('Exporting products to /backup');
        $products = DB::table('products')->get();

        if ($products->isEmpty()) {
            $this->warn('No products found to backup.');
        } else {
            File::put($filePath, $products->toJson(JSON_PRETTY_PRINT));
        }

        // 3. Reset the Database
        $this->warn('Wiping the database....');
        $this->call('migrate:fresh');

        // 4. Seed the Database
        $this->info('Seeding..');
        $this->call('db:seed');

        // 5. Restore Products
        if (File::exists($filePath)) {
            $this->info('Restoring products....');
            $data = json_decode(File::get($filePath), true);

            Schema::disableForeignKeyConstraints();

            // Wipe any seed products to make room for real data
            DB::table('products')->truncate();

            foreach (array_chunk($data, 100) as $chunk) {
                DB::table('products')->insert($chunk);
            }

            Schema::enableForeignKeyConstraints();
            $this->info('Products restored successfully.');
        }

        $this->info('Process completed!');
    }
}
