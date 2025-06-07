<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Remove this "use function Laravel\Prompts\table;" unless you actually use it somewhere else.
// It's not standard for migrations and could be a typo.

class CreateDataLombaTable extends Migration
{
    public function up()
    {
        Schema::create('data_lomba', function (Blueprint $table) {
            $table->increments('id_lomba')->unsigned(); // This is correctly defined as AUTO_INCREMENT PRIMARY KEY
            $table->string('nama_lomba', 255);
            $table->date('tgl_dibuka');
            $table->date('tgl_ditutup');
            $table->integer('tingkat');
            $table->integer('jenis');
            $table->string('tingkat_penyelenggara', 255);
            $table->string('penyelenggara', 255);
            $table->string('alamat', 255);
            $table->string('link_lomba', 255)->nullable();
            $table->enum('verifikasi', ['Pending', 'Rejected', 'Accepted']);
            
            // CORRECTED LINE: Remove the '10' from integer.
            // Also, 'biaya' should typically be a decimal or float if it can have cents,
            // or just an integer if it's always whole numbers (e.g., in IDR without cents).
            // For currency, `decimal` or `float` is often better.
            $table->integer('biaya')->nullable()->default(0); // Set a default of 0 if gratis
            // If you need decimal values for 'biaya', use:
            // $table->decimal('biaya', 10, 2)->nullable()->default(0.00); // 10 total digits, 2 decimal places

            $table->string('hadiah', 255)->nullable();
            $table->timestamps();

            $table->foreign('tingkat')->references('id_tingkat')->on('tingkat');
            
            // IMPORTANT: If you don't have a 'kategori' column in your data_lomba table
            // or a 'kategori' table with 'id_kategori', you MUST comment out or remove this line.
            // Based on your seeder, you don't have a 'kategori' column.
            // $table->foreign('kategori')->references('id_kategori')->on('kategori');
            
            $table->foreign('jenis')->references('id_jenis')->on('jenis');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_lomba');
    }
}