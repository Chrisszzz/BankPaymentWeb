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
    ];

    public function detailTagihan()
    {
        return $this->belongsTo(DetailTagihan::class, 'id_dtl_tagihan', 'id_dtl_tagihan');
    }
}
