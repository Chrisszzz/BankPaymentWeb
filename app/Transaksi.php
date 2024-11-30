<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_pengguna',
        'id_bank',
        'id_tagihan',
        'status',
        'deskripsi',
        'jmlh_bayar',
        'status_verifikasi'
    ];

     // Relasi ke tabel Tagihan
     public function tagihan()
     {
         return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
     }

     // Relasi ke tabel User
     public function user()
     {
         return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
     }

}
