<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = [
        'id',
        'nrp',
        'file',
        'penugasans_id'
    ];

    public static function getByKelasId($kelasId) {
        $listTugas = self::query()->where("kelas_id","=",$kelasId)->get();
        return $listTugas;
    }
    public static function getByPenugasansId($penugasansId) {
        $listTugas = self::query()->where("penugasans_id","=",$penugasansId)->get();
        return $listTugas;
    }
}
