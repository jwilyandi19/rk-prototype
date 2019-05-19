<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'id',
        'kelas_id',
        'user_id',
    ];

    public static function enroll($userId, $kelasId) {
        $enrollment = new Enrollment();
        $enrollment->fill(
            [
                'kelas_id' => $kelasId,
                'user_id' => $userId
            ]
        );
        $enrollment->save();
    }

    public static function expel($userId, $kelasId) {
        self::query()->where("kelas_id", "=", $kelasId)->where("user_Id", "=", $userId)->delete();
    }

    public static function removeByIdKelas($kelasId) {
        self::query()->where("kelas_id", "=", $kelasId)->delete();
    }
}
