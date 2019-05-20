<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Pengguna;
use Illuminate\Hashing\BcryptHasher;
use App\Materi;
use Illuminate\Support\Facades\View;
use App\Enrollment;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Response;
use App\Tugas;
use Illuminate\Support\Facades\Redirect;
use App\Penugasan;

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
                $this->createPublicDirectory($kodeKelas);
                Enrollment::enroll($user->getAttribute('id'), $kelas->getAttribute('id'));
                $this->data['success'] = "Berhasil membuat kelas dengan kode kelas ".$kodeKelas;
                return View::make('kelas.buat', $this->data);
            }
        }
        $this->data['error'] = "Kode kelas sudah terpakai!";
        return View::make('kelas.buat', $this->data);
    }

    public function doFind(Request $request){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($request->post('kodeKelas'));
        if($kelas == null){
            $this->data['error'] = "Kelas tidak ditemukan!";
            return $this->index($request);
        }
        return Redirect::to("/kelas/".$kelas->getAttribute('kode_kelas'));
    }

    public function view(Request $request, $kodeKelas){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($kelas == null){
            return \abort(404, "Not Found");
        }
        $isPengajar = $kelas->getAttribute('id_pengajar') == $user->getAttribute('id');
        if($isPengajar){
            $listPengguna = Enrollment::getUsersByKelasId($kelas->getAttribute('id'));
            $this->data['listPengguna'] = $listPengguna;
        }
        $this->data['isEnrolling']= Enrollment::isUserIdEnrollingInKelasId($user->getAttribute('id'), $kelas->getAttribute('id'));
        $this->data['listMateri'] = Materi::getByIdKelas($kelas->getAttribute('id'));
        $this->data['listTugas'] =  Penugasan::getByIdKelas($kelas->getAttribute('id'));
        $this->data['isPengajar'] = $isPengajar;
        $this->data['kelas'] = $kelas;
        return View::make('kelas.lihat', $this->data);
    }

    public function delete(Request $request, $kodeKelas) {
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($kelas == null){
            return \abort(404, "Not Found");
        }
        $this->data['kelas'] = $kelas;
        $userId = $user->getAttribute('id');
        if($userId != $kelas->getAttribute('id_pengajar')){
            return \abort(403, "Forbidden");
        }
        return View::make('kelas.hapus', $this->data);
    }

    public function doDelete(Request $request, $kodeKelas){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($kelas == null){
            return \abort(404, "Not Found");
        }
        $userId = $user->getAttribute('id');
        if($userId != $kelas->getAttribute('id_pengajar')){
            return \abort(403, "Forbidden");
        }
        $kelas->delete();
        return Redirect::to("/kelas");
    }

    public function update(Request $request, $kodeKelas){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($kelas == null){
            return \abort(404, "Not Found");
        }
        $userId = $user->getAttribute('id');
        if($userId != $kelas->getAttribute('id_pengajar')){
            return \abort(403, "Forbidden");
        }
        if($request->has('status')){
            $this->data['success'] = "Berhasil mengupdate kelas";
        }
        $this->data['kelas'] = $kelas;
        return View::make("kelas.ubah", $this->data);
    }

    public function doUpdate(Request $request, $kodeKelas){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($kelas == null){
            return \abort(404, "Not Found");
        }
        $userId = $user->getAttribute('id');
        if($userId != $kelas->getAttribute('id_pengajar')){
            return \abort(403, "Forbidden");
        }
        $targetKelas = Kelas::getByKodeKelas($request->post('kodeKelas'));
        if($targetKelas == null || $kodeKelas == $request->post('kodeKelas')){
            $kelas->setAttribute('kode_kelas', $request->post('kodeKelas'));
            $kelas->setAttribute('nama_kelas', $request->post('namaKelas'));
            $kelas->save();
            return Redirect::to("/kelas/".$kelas->getAttribute('kode_kelas').'/ubah?status=1');
        }
        $this->data['kelas'] = $kelas;
        $this->data['error'] = "Kode kelas sudah dimiliki kelas lain!";
        return View::make("kelas.ubah", $this->data);
    }


    public function enroll(Request $request, $kodeKelas){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($kelas == null){
            return \abort(404, "Not Found");
        }
        $this->data['kelas'] = $kelas;
        return View::make("kelas.enroll", $this->data);
    }

    public function doEnroll(Request $request, $kodeKelas){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($kelas == null){
            return \abort(404, "Not Found");
        }
        Enrollment::enroll($user->getAttribute('id'), $kelas->getAttribute('id'));
        return Redirect::to('/kelas/'.$kodeKelas);
    }

    public function expell(Request $request, $kodeKelas){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($kelas == null){
            return \abort(404, "Not Found");
        }
        $this->data['kelas'] = $kelas;
        return View::make("kelas.expell", $this->data);
    }

    public function doExpell(Request $request, $kodeKelas){
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($kelas == null){
            return \abort(404, "Not Found");
        }
        Enrollment::expel($user->getAttribute('id'), $kelas->getAttribute('id'));
        return Redirect::to('/kelas');
    }

    private function createPublicDirectory($kelasId) {
        $base = \public_path();
        $result = $base."\\resource\kelas\\".$kelasId;
        if(!\file_exists($result)){
            mkdir($result,0777,true);
        }
    } 
}
