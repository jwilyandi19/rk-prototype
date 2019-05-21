<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{

    protected $fillable = [
        'id',
        'id_kelas',
        'judul_materi',
        'isi_materi'
    ];

    public static function mockMateri() {
        $materi = new Materi();
        $materi->fill([
            'id' => 1,
            'id_kelas' => 1,
            'judul_materi' => 'Penting',
            'isi_materi' => 'Bumi itu persegi',
        ]);
        return $materi;
    }

    /**
     * @param int $idKelas
     * @return Materi
     */
    public static function getByIdKelas($idKelas){
        $listMateri = self::query()->where('id_kelas','=',$idKelas)->get();
        return $listMateri;
    }

    public static function getById($id) {
        return self::query()->where('id','=',$id)->first();
    }
}
