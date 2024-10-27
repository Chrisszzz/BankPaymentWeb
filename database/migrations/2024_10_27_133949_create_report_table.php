<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('jenis_laporan',50);
            $table->string('lokasi_berkas');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }
}
