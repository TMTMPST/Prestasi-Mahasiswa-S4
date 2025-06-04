<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeahlianMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('keahlian_mahasiswa', function (Blueprint $table) {
            $table->string('nim'); // sama tipe dengan mahasiswa.nim
            $table->integer('id_jenis'); // disesuaikan dengan jenis.id_jenis

            $table->timestamps();

            $table->primary(['nim', 'id_jenis']);

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('keahlian_mahasiswa');
    }
}
