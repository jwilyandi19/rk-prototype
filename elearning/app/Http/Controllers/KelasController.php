<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Pengguna;
use Illuminate\Hashing\BcryptHasher;
use App\Materi;
use Illuminate\Support\Facades\View;

class KelasController extends UserController
{

    public function index(Request $request){
        $user = $this->getSessionUser($request);
        $kelasList = Kelas::getByUserId($user->getAttribute('id'));
        $this->data['kelasList'] = $kelasList;
        return View::make('kelas.home', $this->data);
    }

    public function create(Request $request) {
        $user = $this->getSessionUser($request);
        return View::make('kelas.buat', $this->data);
    }

    public function doCreate(Request $request) {
        $user = $this->getSessionUser($request);
        if($request->has(["kodeKelas", "namaKelas"])){
            $kodeKelas = $request->post("kodeKelas");
            $kelas = Kelas::getByKodeKelas($kodeKelas);
            if($kelas == null){
                $namaKelas = $request->post("namaKelas");
                $kelas = new Kelas();
                $kelas->fill(
                    [
                        'kode_kelas' => $kodeKelas,
                        'nama_kelas' => $namaKelas,
                        'id_pengajar'=> $user->getAttribute('id')
                    ]
                );
                $kelas->save();
                $this->data['success'] = "Berhasil membuat kelas dengan kode kelas ".$kodeKelas;
                return View::make('kelas.buat', $this->data);
            }
        }
        $this->data['error'] = "Kode kelas sudah terpakai!";
        return View::make('kelas.buat', $this->data);
    }

    public function view(Request $request, $kodeKelas){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        $this->data['kelas'] = $kelas;
        return View::make('kelas.view', $this->data);
    }
}
