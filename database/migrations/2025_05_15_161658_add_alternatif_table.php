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
        Schema::create('nilai_kriteria', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('id_lomba');
    $table->unsignedInteger('id_kriteria');
    $table->float('nilai'); // Nilai numerik sesuai skala penilaian

    $table->timestamps();

    $table->foreign('id_lomba')->references('id_lomba')->on('data_lomba')->onDelete('cascade');
    $table->foreign('id_kriteria')->references('id')->on('kriteria')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
