<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';

    protected $fillable = [
            'id_instansi',
            'id_dtl_tagihan',
            'jmlh_tgh',
            'tgl_jth_tempo',
            'status',
            'deskripsi',
    ];
}
