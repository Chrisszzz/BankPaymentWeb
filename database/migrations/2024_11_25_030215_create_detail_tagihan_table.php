<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTagihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_tagihan', function (Blueprint $table) {
            $table->increments('id_dtl_tagihan'); // INT, Primary Key, Auto Increment
            $table->integer('biaya_sks');  // integer untuk biaya SKS
            $table->integer('biaya_ICE');  // integer untuk biaya ICE
            $table->integer('biaya_kesehatan'); // integer untuk biaya lainnya
            $table->integer('biaya_gedung'); // integer untuk biaya lainnya
            $table->integer('potongan_prestasi'); // integer untuk biaya lainnya
            $table->integer('hrg_denda');  // integer untuk harga denda
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
        Schema::dropIfExists('detail_tagihan');
    }
}
