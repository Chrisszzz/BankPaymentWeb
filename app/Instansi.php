<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';

    public $timestamps = false;

    protected $fillable =  [
                            'kode_instansi',
                            'nm_instansi',
                            'total_mahasiswa',
                            'tgl_mulai_kerjasama',
                            'tgl_akhir_kerjasama',
                           ];

}
