<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('short_description');
            $table->text('full_description');
            $table->decimal('price', 7, 2)->default(0);
            $table->integer('quantity')->default(20);
            $table->string('image_path', 100);
            $table->string('image_name', 100);
            $table->string('category', 20);
            $table->string('classification', 20)->default('default')->comment('default,exclusive,featured,upcoming');
            $table->string('status', 50)->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
