<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['kode_kelas','nama_kelas','id_pengajar'];
}
