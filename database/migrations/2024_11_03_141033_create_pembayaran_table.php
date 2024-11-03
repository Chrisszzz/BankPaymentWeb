<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('id_pembayaran',10)->primary();
            $table->unsignedBigInteger('id_tagihan');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_bank');
            $table->unsignedBigInteger('id_instansi');
            $table->integer('jumlah');

            $table->foreign('id_pengguna')->references('id_pengguna')->on('users');
            $table->foreign('id_bank')->references('id_bank')->on('bank');
            $table->foreign('id_instansi')->references('id_instansi')->on('instansi');
            $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
