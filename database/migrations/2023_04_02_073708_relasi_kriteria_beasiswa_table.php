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
        // Schema::table('beasiswa_indikator', function (Blueprint $table) {
        //     $table->unsignedBigInteger('indikator_id')->nullable();
        //     $table->foreign('indikator_id')->references('indikator_id')->on('indikator');
        //     $table->unsignedBigInteger('beasiswa_id')->nullable();
        //     $table->foreign('beasiswa_id')->references('beasiswa_id')->on('beasiswa');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('beasiswa_indikator', function (Blueprint $table) {
        //     $table->string('indikator_id');
        //     $table->dropForeign(['indikator_id']);
        //     $table->string('beasiswa');
        //     $table->dropForeign(['beasiswa_id']);
        // });
    }
};
