<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Va extends Model
{
    protected $table = 'va';
    protected $primaryKey = 'no_va';
    protected $fillable = [
        'no_va',
        'id_mahasiswa',
        'id_tagihan',
        'status_va',
    ];

    protected $casts = [
        'status_va' => 'string',
    ];

    // Relasi dengan model Tagihan, setiap VA berhubungan dengan satu tagihan
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

}
