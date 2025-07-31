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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['membership', 'session', 'package', 'other']);
            $table->enum('method', ['cash', 'card', 'bank_transfer', 'online']);
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('transaction_id')->nullable();
            $table->string('gateway')->nullable()->comment('Payment gateway used (cardknox, sola, etc.)');
            $table->text('notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index('client_id');
            $table->index('status');
            $table->index('type');
            $table->index('processed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};