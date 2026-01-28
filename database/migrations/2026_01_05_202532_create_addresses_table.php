<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('type')->default(0)->comment('1=shipping,2=billing,3=shipping and billing');
            $table->tinyInteger('is_default')->default(0)->comment('0=not default, 1=default');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100);
            $table->string('contact', 12)->nullable();
            $table->string('line_1', 255);
            $table->string('line_2', 255)->nullable();
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('zip_code', 10)->nullable();
            $table->string('country', 100);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
