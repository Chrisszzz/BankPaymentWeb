<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihannTable extends Migration
{

    public function up()
    {
        Schema::create('tagihann', function (Blueprint $table) {
            $table->increments('id_tagihan'); // INT UNSIGNED, Primary Key
            $table->unsignedBigInteger('id_instansi'); // BIGINT UNSIGNED, Foreign Key ke tabel instansi
            $table->unsignedInteger('id_dtl_tagihan'); // INT UNSIGNED, Foreign Key ke tabel detail_tagihan
            $table->unsignedInteger('id_mahasiswa'); // INT, Primary Key, Auto Increment
            $table->decimal('jmlh_tgh', 10, 2); // Jumlah Tagihan
            $table->date('tgl_jth_tempo'); // Tanggal Jatuh Tempo
            $table->enum('status', ['Belum Dibayar', 'Dibayar']); // Status
            $table->string('deskripsi', 255); // Deskripsi
            $table->string('periode', 50); // Periode
            $table->integer('sks'); // sks
            $table->string('ice', 50); // ice
            $table->timestamps(); // created_at & updated_at

            // Foreign key ke tabel instansi
            $table->foreign('id_instansi')
                  ->references('id')->on('instansi') // Referensi ke tabel instansi
                  ->onDelete('cascade') // Hapus tagihan jika instansi dihapus
                  ->onUpdate('cascade'); // Perbarui tagihan jika id_instansi berubah

            // Foreign key ke tabel detail_tagihan
            $table->foreign('id_dtl_tagihan')
                  ->references('id_dtl_tagihan')->on('detail_tagihan') // Referensi ke tabel detail_tagihan
                  ->onDelete('cascade') // Hapus tagihan jika detail_tagihan dihapus
                  ->onUpdate('cascade'); // Perbarui tagihan jika id_dtl_tagihan berubah

            $table->foreign('id_mahasiswa')
                  ->references('id_mahasiswa')->on('mahasiswa') // Referensi ke tabel instansi
                  ->onDelete('cascade') // Hapus tagihan jika instansi dihapus
                  ->onUpdate('cascade'); // Perbarui tagihan jika id_instansi berubah
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihann');
    }
}
