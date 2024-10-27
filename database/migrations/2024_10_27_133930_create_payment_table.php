<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');
            $table->unsignedBigInteger('id_tagihan');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_bank');
            $table->integer('no_va');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('users');
            $table->foreign('id_bank')->references('id_bank')->on('bank');
            $table->foreign('id_tagihan')->references('id_tagihan')->on('bill');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
