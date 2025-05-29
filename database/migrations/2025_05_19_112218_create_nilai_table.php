<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();

            // Foreign key ke santris
            $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');

            // Nilai-nilai
            $table->string('hafalan')->nullable();
            $table->tinyInteger('perkembangan')->unsigned()->default(0);
            $table->tinyInteger('akhlak')->unsigned()->default(0);

            // Periode penilaian
            $table->integer('tahun');
            $table->tinyInteger('bulan');

            // Foreign key ke users (operator) / pembimbing
            $table->foreignId('operator_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
};
