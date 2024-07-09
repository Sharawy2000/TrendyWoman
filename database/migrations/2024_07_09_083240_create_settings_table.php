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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contact_with_u_s')->cascadeOnDelete();
            $table->foreignId('text_id')->constrained('system_texts')->cascadeOnDelete();
            $table->string('terms_conditions')->nullable();
            $table->text('who_are_we')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
