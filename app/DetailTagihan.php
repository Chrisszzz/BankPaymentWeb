<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTagihan extends Model
{
    protected $table = 'detail_tagihan';

    protected $fillable =  [
                            'biaya_sks',
                            'biaya_ICE',
                            'biaya_lainnya',
                            'hrg_denda'
                           ];
}
