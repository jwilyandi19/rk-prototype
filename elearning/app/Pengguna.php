<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'id',
        'nrp',
        'password',
        'rule',
        'created_at',
        'updated_at'
    ];
}
