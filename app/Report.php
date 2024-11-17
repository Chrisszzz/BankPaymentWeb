<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';

    protected $fillable =  [
                            'id_pengguna',
                            'jenis_lap',
                            'tgl_dihasilakan',
                            'lokasi_berkas',
                           ];


}
