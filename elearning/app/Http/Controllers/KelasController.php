<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Pengguna;

class KelasController extends Controller
{

    private function getUser($userId) {
        //TODO : Remove Mock
        $user = new Pengguna();
        $user->fill([''])
    }

    public function index(Request $request){
        return \view('kelas.home', ['kelas' => Kelas::all()]);
    }

    public function view(Request $request){
        return 
    }
}
