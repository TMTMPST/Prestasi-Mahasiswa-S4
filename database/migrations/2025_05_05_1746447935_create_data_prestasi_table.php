<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPrestasiTable extends Migration
{
    public function up()
    {
        Schema::create('data_prestasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim', 15);
            $table->enum('peringkat', ['Juara 1', 'Juara 2', 'Juara 3', 'Harapan 1', 'Harapan 2', 'Harapan 3']);
            $table->integer('id_lomba')->unsigned();
            $table->string('sertif', 255);
            $table->string('foto_bukti', 255);
            $table->enum('verifikasi', ['Pending', 'Rejected', 'Accepted']);
            $table->string('poster_lomba', 255);
            $table->text('keterangan')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_lomba')->references('id_lomba')->on('data_lomba');
            $table->foreign('updated_by')->references('username')->on('admin')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_prestasi');
    }
}
