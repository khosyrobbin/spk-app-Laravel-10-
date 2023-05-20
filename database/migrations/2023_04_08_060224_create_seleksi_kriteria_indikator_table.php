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
        Schema::create('indikator_seleksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seleksi_seleksi_id')->constrained('seleksi', 'seleksi_id');
            $table->foreignId('indikator_indikator_id')->constrained('indikator', 'indikator_id');
            // new
            $table->integer('bobot')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_seleksi');
    }
};
