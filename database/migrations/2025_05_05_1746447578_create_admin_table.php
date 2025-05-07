<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->string('nip', 15)->primary();
            $table->string('nama', 100);
            $table->string('password');
            $table->char('level', 3);
            $table->foreign('level')->references('id_level')->on('level');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
