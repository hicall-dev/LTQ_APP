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
        Schema::table('santris', function (Blueprint $table) {
            $table->unsignedBigInteger('pembimbing_id')->nullable()->after('operator_id');
            $table->foreign('pembimbing_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->dropForeign(['pembimbing_id']);
            $table->dropColumn('pembimbing_id');
        });
    }
};
