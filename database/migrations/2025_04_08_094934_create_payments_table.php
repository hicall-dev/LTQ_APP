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
            $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');
            $table->unsignedTinyInteger('bulan'); // 1 - 12
            $table->unsignedSmallInteger('tahun'); // Contoh: 2025
            $table->unsignedTinyInteger('status')->default(0); // 0 = belum, 1 = lunas, 2 = gratis
            $table->timestamps();
            $table->foreignId('operator_id')->constrained(
                table: 'users',
                indexName: 'payments_operator_id'
            );
            $table->unique(['santri_id', 'bulan', 'tahun']); // Hindari duplikat data
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
