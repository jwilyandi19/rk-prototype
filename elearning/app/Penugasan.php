<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    protected $table = 'penugasans';
    
    
    protected $fillable = [
        'id',
        'id_kelas',
        'file'
    ];

    public static function getByIdKelas($idKelas){
        $listMateri = self::query()->where('id_kelas','=',$idKelas)->get();
        return $listMateri;
    }
}
