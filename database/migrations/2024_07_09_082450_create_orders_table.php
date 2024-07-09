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
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('package_id')->constrained('packages');
            $table->foreignId('size_id')->constrained('sizes');
            $table->foreignId('body_shape_id')->constrained('body_shapes');
            $table->foreignId('order_image_id')->constrained('order_images');
            $table->string('user_name');
            $table->string('user_phone');
            $table->string('age');
            $table->string('gender');
            $table->string('occation');
            $table->dateTime('occation_date');
            $table->string('balance');
            $table->string('value_added')->nullable();
            $table->string('order_price')->nullable();
            $table->string('rating')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->string('cancel_reason')->nullable();
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
