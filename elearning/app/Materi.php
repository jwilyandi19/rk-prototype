<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['id_kelas','judul_materi','isi_materi'];
    
}
