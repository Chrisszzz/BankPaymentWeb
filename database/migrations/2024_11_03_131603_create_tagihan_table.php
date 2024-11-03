<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->bigIncrements('id_tagihan');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_instansi');
            $table->integer('jumlah');
            $table->date('tgl_jatuh_tempo');
            $table->string('status', 20);
            $table->string('deskripsi', 100);
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('users');
            $table->foreign('id_instansi')->references('id_instansi')->on('instansi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihan');
    }
}
