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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->text('address')->nullable();
            $table->text('emergency_contact')->nullable();
            $table->text('medical_notes')->nullable();
            $table->enum('status', ['active', 'inactive', 'follow-up'])->default('active');
            $table->decimal('outstanding_balance', 10, 2)->default(0);
            $table->timestamps();
            
            // Indexes for performance
            $table->index('email');
            $table->index('status');
            $table->index(['first_name', 'last_name']);
            $table->index('outstanding_balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};