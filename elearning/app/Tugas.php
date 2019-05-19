<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';

    
    protected $fillable = [
        'id',
        'nrp',
        'penugasans_id'
    ];
}
