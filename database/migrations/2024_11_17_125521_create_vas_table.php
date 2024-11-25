<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('va', function (Blueprint $table) {
            $table->bigIncrements('no_va'); // INT(16), Primary Key, Auto Increment
            $table->unsignedInteger('id_mahasiswa'); // INT(10), Foreign Key ke tabel Mahasiswa
            $table->unsignedInteger('id_tagihan'); // INT(10), Foreign Key ke tabel Tagihan
            $table->dateTime('tgl_request'); // DATETIME, Tanggal dan waktu request
            $table->dateTime('tgl_kadaluwarsa'); // DATETIME, Tanggal dan waktu kadaluwarsa VA
            $table->enum('status_va', ['Pending', 'Ditolak', 'Selesai']); // ENUM, Status VA
            $table->timestamps(); // created_at & updated_at

            // Definisi Foreign Key
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('va');
    }
}
