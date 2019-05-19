<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function isUserIdEnrollingInKelasId($userId, $kelasId){
        $result = self::query()->where('kelas_id', '=', $kelasId)->where('user_id', '=', $userId)->first();
        return $result != null;
    }

    public static function removeByKelasId($kelasId) {
        self::query()->where("kelas_id", "=", $kelasId)->delete();
    }

    public static function getKelasByUserId($userId) {
        $result = [];
        $enrollments = self::query()->where("user_id", "=", $userId)->get();
        foreach($enrollments as $enrollment){
            $result[] = Kelas::getById($enrollment->getAttribute('id'));
        }
        return $result;
    }

    public static function getUsersByKelasId($kelasId){
        $result = [];
        $enrollments = self::query()->where("kelas_id", "=", $kelasId)->get();
        foreach($enrollments as $enrollment){
            $result[] = Pengguna::getById($enrollment->getAttribute('user_id'));
        }
        return $result;
    }
}
