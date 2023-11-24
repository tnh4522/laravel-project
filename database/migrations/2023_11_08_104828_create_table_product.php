<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->integer('web_id');
            $table->string('name');
            $table->integer('price');
            $table->string('image');
            $table->boolean('availability');
            $table->boolean('condition');
            $table->integer('sales');
            $table->text('description');
            $table->text('details');
            $table->string('manufacturer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
