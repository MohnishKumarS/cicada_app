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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_id');
            $table->string('full_name');
            $table->string('email');
            $table->text('address');
            $table->string('city');
            $table->string('pincode');
            $table->string('state');
            $table->string('mobile');
            $table->text('message')->nullable();
            $table->string('payment_method'); // 'cod' or 'online'
            $table->mediumText('payment_id')->nullable(); 
            $table->integer('total_amount');
            $table->string('status')->default('0');
            $table->string('user_device')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
