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
        return self::query()->where('kode_kelas','=',$kodeKelas)->first();
    } 

    public static function getById($id){
        return self::query()->where('id','=',$id)->first();
    }

    public static function getByUserId($userId) {
        $kelas = [];
        $kelasIds = Enrollment::query()->where('user_id','=',$userId)->get();
        foreach($kelasIds as $id){
            $kelas[] = self::getById($id->getAttribute('kelas_id'));
        }
        return $kelas;
    }

    public function delete() {
        Enrollment::removeByKelasId($this->getAttribute('id'));
        $this->query()->where('id', "=", $this->getAttribute('id'))->delete();
    }
}
