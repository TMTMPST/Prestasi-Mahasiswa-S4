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
            $table->string('nama', 100);
            $table->string('password');
            $table->string('prodi', 100);
            $table->char('level', 3);
            $table->integer('poin_presma')->default(0); // Add this line
            $table->timestamps();
            $table->foreign('level')->references('id_level')->on('level');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
