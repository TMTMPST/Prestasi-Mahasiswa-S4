<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisTable extends Migration
{
    public function up()
    {
        Schema::create('jenis', function (Blueprint $table) {
            $table->integer('id_jenis')->primary();
            $table->string('nama_jenis', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis');
    }
}
