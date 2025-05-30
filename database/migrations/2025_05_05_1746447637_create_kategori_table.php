<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTable extends Migration
{
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->integer('id_kategori')->primary();
            $table->string('nama_kategori', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori');
    }
}
