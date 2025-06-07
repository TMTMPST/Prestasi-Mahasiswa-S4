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
         Schema::create('bimbingan', function (Blueprint $table) {
        $table->increments('id_bimbingan');
        $table->unsignedInteger('id_lomba');
        $table->string('nama_pengaju');
        $table->string('nip');
        $table->string('nim');
        $table->text('deskripsi_lomba');
        $table->enum('status', ['Pending', 'Rejected', 'Accepted'])->default('Pending');
        $table->timestamps();

        $table->foreign('id_lomba')->references('id_lomba')->on('data_lomba');
        $table->foreign('nip')->references('nip')->on('dosen');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingan');
    }
};
