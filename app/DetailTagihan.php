<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTagihan extends Model
{
    protected $table = 'detail_tagihan';
    protected $primaryKey = 'id_dtl_tagihan';
    protected $fillable =  [
                            'biaya_sks',
                            'biaya_ICE',
                            'biaya_kesehatan',
                            'biaya_gedung',
                            'potongan_prestasi',
                            'hrg_denda'
                           ];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'id_dtl_tagihan', 'id_dtl_tagihan');
    }
}
