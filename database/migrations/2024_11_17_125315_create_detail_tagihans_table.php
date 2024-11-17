<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTagihansTable extends Migration
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
            $table->decimal('biaya_sks', 10, 2);  // DECIMAL(10,2) untuk biaya SKS
            $table->decimal('biaya_ICE', 10, 2);  // DECIMAL(10,2) untuk biaya ICE
            $table->decimal('biaya_lainnya', 10, 2); // DECIMAL(10,2) untuk biaya lainnya
            $table->decimal('hrg_denda', 10, 2);  // DECIMAL(10,2) untuk harga denda
            $table->timestamps();                // created_at & updated_at
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
