<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi'); // INT UNSIGNED, Primary Key, Auto Increment
            $table->unsignedBigInteger('id_pengguna'); // BIGINT UNSIGNED, Foreign Key ke tabel pengguna
            $table->unsignedBigInteger('id_bank'); // BIGINT UNSIGNED, Foreign Key ke tabel bank
            $table->dateTime('tanggal'); // DATETIME, Tanggal dan Waktu Transaksi
            $table->enum('status', ['Berhasil', 'Gagal', 'Menunggu']); // ENUM, Status transaksi
            $table->string('desk', 255); // VARCHAR(255), Deskripsi
            $table->decimal('jmlh', 10, 2); // DECIMAL(10,2), Jumlah Transaksi
            $table->timestamps(); // created_at & updated_at

            // Foreign key ke tabel pengguna
            $table->foreign('id_pengguna')
                  ->references('id_pengguna')->on('users') // Referensi ke tabel pengguna
                  ->onDelete('cascade') // Hapus transaksi jika pengguna dihapus
                  ->onUpdate('cascade'); // Update transaksi jika id_pengguna berubah

            // Foreign key ke tabel bank
            $table->foreign('id_bank')
                  ->references('id_bank')->on('bank') // Referensi ke tabel bank
                  ->onDelete('cascade') // Hapus transaksi jika bank dihapus
                  ->onUpdate('cascade'); // Update transaksi jika id_bank berubah
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
