<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    protected $table = 'penugasan';

    
    protected $fillable = [
        'id',
        'id_kelas',
        'file'
    ];
}
