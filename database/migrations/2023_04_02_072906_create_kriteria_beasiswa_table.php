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
        Schema::create('beasiswa_kriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beasiswa_beasiswa_id')->constrained('beasiswa', 'beasiswa_id')->onDelete('restrict');;
            $table->foreignId('kriteria_kriteria_id')->constrained('kriteria', 'kriteria_id')->onDelete('restrict');;
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beasiswa_kriteria');
    }
};
