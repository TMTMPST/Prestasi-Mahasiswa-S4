<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTingkatTable extends Migration
{
    public function up()
    {
        Schema::create('tingkat', function (Blueprint $table) {
            $table->integer('id_tingkat')->primary();
            $table->string('nama_tingkat', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tingkat');
    }
}
