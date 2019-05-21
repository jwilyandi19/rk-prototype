<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materi;
use App\Kelas;
use Illuminate\Support\Facades\View;

class MateriController extends UserController
{

    public function index(Request $request, $kodeKelas, $id) {
        $user = $this->getSessionUser($request);
        $materi = Materi::getById($id);
        if($materi == null) {
            return \abort(404, "Not Found");
        }
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        $this->data['kelas'] = $kelas;
        if($materi->getAttribute('id_kelas')!=$kelas->getAttribute('id')) {
            return \abort(403, "Forbidden");
        }
        $this->data['materi'] = $materi;
        return View::make('materi.lihat', $this->data);
    }

    public function create(Request $request, $kodeKelas) {
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        $this->data['kelas'] = $kelas;
        return View::make('materi.buat', $this->data);
    }

    public function doCreate(Request $request, $kodeKelas) {
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        if($request->has(["judulMateri","isiMateri"])){
            $materi = new Materi();
            $judulMateri = $request->post("judulMateri");
            $isiMateri = $request->post("isiMateri");
            $materi->fill(
                [
                    'id_kelas' => $kelas->getAttribute('id'),
                    'judul_materi'=> $judulMateri,
                    'isi_materi'=> $isiMateri
                ]
            );
            $materi->save();
            $this->data['success'] = "Berhasil membuat materi";
            return View::make('materi.buat',$this->data);
        }
        $this->data['error'] = "Materi gagal terbuat";
        return View::make('materi.buat', $this->data);
    }





}
