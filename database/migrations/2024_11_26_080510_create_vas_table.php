<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('va', function (Blueprint $table) {
            $table->string('no_va', 15)->primary();
            $table->unsignedInteger('id_mahasiswa'); // INT, Primary Key, Auto Increment
            $table->unsignedInteger('id_tagihan'); // INT UNSIGNED, Primary Key
            $table->enum('status_va', ['Aktif', 'Tidak Aktif']);// ENUM, Status VA
            $table->timestamps(); // created_at & updated_at

            $table->foreign('id_mahasiswa')
            ->references('id_mahasiswa')->on('mahasiswa') // Referensi ke tabel instansi
            ->onDelete('cascade') // Hapus tagihan jika instansi dihapus
            ->onUpdate('cascade'); // Perbarui tagihan jika id_instansi berubah

            $table->foreign('id_tagihan')
            ->references('id_tagihan')->on('tagihan') // Referensi ke tabel instansi
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
        Schema::dropIfExists('va');
    }
}
