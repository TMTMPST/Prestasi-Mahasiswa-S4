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
        Schema::create('kriteria', function (Blueprint $table) {
    $table->increments('id');
    $table->string('nama_kriteria', 100);
    $table->enum('tipe', ['benefit', 'cost']);
    $table->float('bobot'); // misal: 0.3, 0.2, dst.
    $table->timestamps();
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
