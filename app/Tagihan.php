<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';
    protected $primaryKey = 'id_tagihan';
    protected $fillable = [
            'id_instansi',
            'id_dtl_tagihan',
            'id_mahasiswa',
            'jmlh_tgh',
            'tgl_jth_tempo',
            'status',
            'deskripsi',
            'periode',
            'sks',
            'ice',
            'potongan_prestasi',
            'denda',
            'no_va',
            'status_transaksi',
    ];

    public function detailTagihan()
    {
        return $this->belongsTo(DetailTagihan::class, 'id_dtl_tagihan', 'id_dtl_tagihan');
    }

    // Relasi dengan model Va, satu tagihan memiliki satu VA
    public function va()
    {
        return $this->hasOne(Va::class, 'id_tagihan', 'id_tagihan');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'kode_instansi');
    }

}
