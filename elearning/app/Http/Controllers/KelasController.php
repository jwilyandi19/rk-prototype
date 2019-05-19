<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Pengguna;
use Illuminate\Hashing\BcryptHasher;

class KelasController extends Controller
{

    /**
     * Get User From source
     *
     * @param int $userId
     * @return Pengguna
     */
    private function getUser($userId) {
        if(\getenv('APP_DEBUG')){
            $hasher = new BcryptHasher();
            $user = new Pengguna();
            $user->fill(
                ['id' => $userId,
                'nrp' => '05111640000059',
                'password' => $hasher->make('password')]);
            return $user;
        }else{
            //TODO : Connect Database
        }
    }

    public function index(Request $request){
        return \view('kelas.home', ['kelas' => Kelas::all()]);
    }

    public function view(Request $request, $kodeKelas){
        $user = $this->getUser($request->session()->get('userId', 0));
        $data = [];

        return \view('kelas.view', $data);
    }
}
