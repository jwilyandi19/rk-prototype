<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{

    protected $fillable = [
        'id',
        'nrp',
        'password',
        'role'
    ];

    /**
     * @param int $idKelas
     * @return Materi
     */
    public static function getByIdKelas($idKelas){
        $listMateri = self::query()->where('id_kelas','=',$idKelas)->get();
        return $listMateri;
    }
}
