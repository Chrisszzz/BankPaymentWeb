<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary Key, auto increment
            $table->string('kode_instansi', 10);
            $table->string('nm_instansi', 100); // Nama instansi dengan panjang 100 karakter
            $table->integer('total_mahasiswa');
            $table->date('tgl_mulai_kerjasama'); // Tanggal mulai kerjasama
            $table->date('tgl_akhir_kerjasama'); // Tanggal akhir kerjasama
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instansi');
    }
}
