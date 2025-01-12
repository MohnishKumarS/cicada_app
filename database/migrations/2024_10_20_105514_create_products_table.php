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
            $table->id();
            $table->string('product_name');
            $table->string('slug');
            $table->text('product_description')->nullable();
            $table->string('size');
            $table->integer('quantity');
            $table->enum('gender', ['male', 'female', 'unisex'])->nullable();
            $table->integer('actual_price');
            $table->integer('offer_price');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('color')->nullable();
            $table->string('main_img');
            $table->string('additional_images')->nullable();   
            $table->integer('stock')->default(1); 
            $table->integer('trending')->default(1);
            $table->integer('status')->default(1);

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
