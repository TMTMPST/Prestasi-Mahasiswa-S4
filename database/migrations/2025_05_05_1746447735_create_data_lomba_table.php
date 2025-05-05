<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataLombaTable extends Migration
{
    public function up()
    {
        Schema::create('data_lomba', function (Blueprint $table) {
            $table->increments('id_lomba')->unsigned();
            $table->string('nama_lomba', 255);
            $table->date('tgl_dibuka');
            $table->date('tgl_ditutup');
            $table->integer('tingkat');
            $table->integer('kategori');
            $table->integer('jenis');
            $table->string('penyelenggara', 255);
            $table->string('alamat', 255);
            $table->timestamps();

            $table->foreign('tingkat')->references('id_tingkat')->on('tingkat');
            $table->foreign('kategori')->references('id_kategori')->on('kategori');
            $table->foreign('jenis')->references('id_jenis')->on('jenis');
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_lomba');
    }
}
