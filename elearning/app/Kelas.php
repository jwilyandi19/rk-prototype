<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kelas extends Model
{

    protected $fillable = [
        'id',
        'kode_kelas',
        'nama_kelas',
        'id_pengajar'
    ];

    public static function mockKelas() {
        $kelas = new Kelas();
        $kelas->fill(
            ['id' => 1,
            'kode_kelas' => "IF1234",
            'nama_kelas' => "Sebuah Mockup",
            'id_pengajar' => "1"]
        );
    }
    /**
     * get kelas by Kode Kelas
     *
     * @param String $kodeKelas
     * @return Kelas
     */
    public static function getByKodeKelas($kodeKelas) {
        $kelas = self::query()->where('kode_kelas','=',$kodeKelas)->first();
        return $kelas;
    } 

    public static function getByUserId($userId) {
        //MOCK LINE
        $kelas = self::mockKelas();
        $kelas = self::mockKelas();
        $kelas = self::mockKelas();
        $kelas = self::mockKelas();
        return $kelas;
        //END MOCK LINE
        $kelas = Enrollment::query()->where('user_id','=',$userId)->get();
        return $kelas;
    }
}
