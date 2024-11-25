<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->increments('id_laporan'); // INT UNSIGNED, Primary Key, Auto Increment
            $table->unsignedBigInteger('id_pengguna'); // BIGINT UNSIGNED, Foreign Key ke tabel pengguna
            $table->enum('jenis_lap', ['Transaksi', 'Pembayaran', 'Tagihan']); // ENUM, Jenis laporan
            $table->date('tgl_dihasilakan'); // DATE, Tanggal pembuatan laporan
            $table->string('lokasi_berkas', 100); // VARCHAR(100), Lokasi Berkas
            $table->timestamps(); // created_at & updated_at

            // Definisi Foreign Key
            $table->foreign('id_pengguna')
                  ->references('id_pengguna')->on('users') // Foreign Key ke tabel pengguna
                  ->onDelete('cascade') // Hapus laporan jika pengguna dihapus
                  ->onUpdate('cascade'); // Update laporan jika id_pengguna berubah
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
