<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim', 15)->primary();
            $table->integer('angkatan');
            $table->string('nama');
            $table->string('password');
            $table->string('prodi');
            $table->string('dosen_nip', 20)->nullable();
            $table->char('level', 3)->default('MHS');
            $table->integer('poin_presma')->default(0);
            $table->string('prestasi_tertinggi')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('level')->references('id_level')->on('level');
            $table->foreign('dosen_nip')->references('nip')->on('dosen')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}

