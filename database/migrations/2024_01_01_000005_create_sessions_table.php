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
        Schema::create('fitness_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('trainer_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['personal', 'group', 'class']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('scheduled_at');
            $table->integer('duration_minutes')->default(60);
            $table->decimal('price', 8, 2)->default(0);
            $table->enum('status', ['scheduled', 'completed', 'cancelled', 'no-show'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index('client_id');
            $table->index('trainer_id');
            $table->index('scheduled_at');
            $table->index('status');
            $table->index(['scheduled_at', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitness_sessions');
    }
};