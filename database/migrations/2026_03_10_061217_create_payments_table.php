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
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->string('month'); // e.g., "March"
            $table->integer('year'); // e.g., 2026
            $table->decimal('day_15_amount', 10, 2)->default(0);
            $table->decimal('day_30_amount', 10, 2)->default(0);
            $table->timestamps();

            // A client should have only one payment record per month/year
            $table->unique(['client_id', 'month', 'year']);
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
