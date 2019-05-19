<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'penggunas';

    protected $fillable = [
        'id',
        'nrp',
        'password',
        'role'
    ];

    public static function mockPengguna(){
        $hasher = new BcryptHasher();
        $user = new Pengguna();
        $user->fill(
            ['id' => 1,
            'nrp' => '05111640000059',
            'password' => $hasher->make('password')]
        );
        return $user;
    }

    public static function getByNrp($nrp) {
        $pengguna = self::query()->where('nrp','=',$nrp)->first();
        return $pengguna;
    }

    public static function getById($id){
        $pengguna = self::query()->where('id','=',$id)->first();
        return $pengguna;
    }
}
