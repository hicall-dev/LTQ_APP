<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->text('tempat_lahir')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->dropColumn('tempat_lahir');
        });
    }
};
