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
        Schema::table('indikator_beasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_indikator')->nullable();
            $table->foreign('id_indikator')->references('id_indikator')->on('indikator');
            $table->unsignedBigInteger('id_beasiswa')->nullable();
            $table->foreign('id_beasiswa')->references('id_beasiswa')->on('beasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indikator_beasiswa', function (Blueprint $table) {
            $table->string('id_indikator');
            $table->dropForeign(['id_indikator']);
            $table->string('beasiswa');
            $table->dropForeign(['id_beasiswa']);
        });
    }
};
