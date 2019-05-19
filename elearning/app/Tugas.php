<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = [
        'id',
        'kelas_id',
        'judul_tugas',
        'deskripsi_tugas'
    ];

    public static function getByKelasId($kelasId) {
        $listTugas = self::query()->where("kelas_id","=",$kelasId)->get();
        return $listTugas;
    }
}
