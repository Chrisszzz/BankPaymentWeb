<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Va extends Model
{
    protected $table = 'va';

    protected $fillable = [
        'id_mahasiswa',
        'id_tagihan',
        'tgl_request',
        'tgl_kadaluwarsa',
        'status_va',
    ];

    protected $casts = [
        'status_va' => 'string',
    ];
}
