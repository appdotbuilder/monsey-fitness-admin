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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('specialties')->nullable()->comment('JSON array of trainer specialties');
            $table->decimal('hourly_rate', 8, 2)->default(0);
            $table->decimal('commission_rate', 5, 2)->default(0)->comment('Commission percentage (0-100)');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('email');
            $table->index('status');
            $table->index(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};