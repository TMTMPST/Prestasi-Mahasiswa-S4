<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    public function up()
    {
         Schema::create('dosen', function (Blueprint $table) {
        $table->string('nip', 15)->primary();
        $table->string('nama', 100);
        $table->string('email', 100)->nullable();
        $table->string('password');
        $table->char('level', 3);
        $table->integer('bidangMinat')->nullable(); // Ubah ke integer
        $table->timestamps();
        $table->foreign('level')->references('id_level')->on('level');
        $table->foreign('bidangMinat')->references('id_jenis')->on('jenis')->nullOnDelete();
    });
    }

    public function down()
    {
        Schema::dropIfExists('dosen');
    }
}
