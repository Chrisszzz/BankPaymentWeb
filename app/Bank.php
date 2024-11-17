<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';

    protected $fillable =  [
                            'nama_bank',
                            'cabang_bank',
                            'email_bank',
                           ];

}
