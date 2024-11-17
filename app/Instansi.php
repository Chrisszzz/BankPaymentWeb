<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';

    protected $fillable =  [
                            'nm_instansi',
                            'tgl_mulai_kerjasama',
                            'tgl_akhir_kerjasama',
                           ];

}
