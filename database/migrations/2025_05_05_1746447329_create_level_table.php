<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelTable extends Migration
{
    public function up()
    {
        Schema::create('level', function (Blueprint $table) {
            $table->char('id_level', 3)->primary();
            $table->string('keterangan', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('level');
    }
}
