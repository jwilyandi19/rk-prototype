<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materi;
use App\Kelas;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

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
        $userId = $user->getAttribute('id');
        $isPengajar = $kelas->getAttribute('id_pengajar') == $userId;;
        if($materi->getAttribute('id_kelas')!=$kelas->getAttribute('id')) {
            return \abort(403, "Forbidden");
        }
        $this->data['isPengajar'] = $isPengajar;
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

    public function update(Request $request, $kodeKelas, $id) {
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        $materi = Materi::getById($id);
        if($materi == null) {
            return \abort(404,"Not Found");
        }
        if($request->has('status')) {
            $this->data['success'] = "Berhasil mengubah materi";
        }
        $this->data['materi'] = $materi;
        return View::make('materi.ubah', $this->data);
    }

    public function doUpdate(Request $request, $kodeKelas, $id) {
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        $materi = Materi::getById($id);
        if($materi == null) {
            return \abort(404, "Not Found");
        }
        if($materi->getAttribute('id_kelas')!=$kelas->getAttribute('id')) {
            return \abort(403, "Forbidden");
        }

        if($request->has(["judulMateri","isiMateri"])){
            $materi->setAttribute("judul_materi", $request->post('judulMateri'));
            $materi->setAttribute("isi_materi", $request->post('isiMateri'));
            $materi->save();
            return Redirect::to("/kelas/".$kelas->getAttribute('kode_kelas')."/materi/".$materi->getAttribute('id').'/ubah?status=1');
        }
        $this->data['materi'] = $materi;
        $this->data['error'] = "Gagal ubah materi";
        return View::make('materi.ubah', $this->data);
    }

    public function delete(Request $request, $kodeKelas, $id) {
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        $materi = Materi::getById($id);

        if($materi==null) {
            return \abort(404, "Not Found");
        }
        $this->data['kelas'] = $kelas;
        $this->data['materi'] = $materi;
        if($materi->getAttribute('id_kelas')!=$kelas->getAttribute('id')) {
            return \abort(403, "Forbidden");
        }
        return View::make('materi.hapus', $this->data);
    }

    public function doDelete(Request $request, $kodeKelas, $id) {
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        $materi = Materi::getById($id);

        if($materi==null) {
            return \abort(404, "Not Found");
        }
        if($materi->getAttribute('id_kelas')!=$kelas->getAttribute('id')) {
            return \abort(403, "Forbidden");
        }
        $materi->delete();
        return Redirect::to("/kelas/".$kelas->getAttribute('kode_kelas'));



        
    }





}
