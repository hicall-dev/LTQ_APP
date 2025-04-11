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
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('nis')->unique();
            $table->string('kelas')->default('Tahfidz');
            $table->boolean('status_spp')->default(false);
            $table->string('golongan');
            // $table->unsignedBigInteger('operator_id');
            // $table->foreign('operator_id')->references('id')->on('users');
            $table->foreignId('operator_id')->constrained(
                table: 'users',
                indexName: 'santris_operator_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
