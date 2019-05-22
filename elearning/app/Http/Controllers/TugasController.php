<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Tugas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Penugasan;
use App\Kelas;

class TugasController extends UserController
{   

    public function index()
    {

    }

    public function AllTugas(Request $request, $kodeKelas, $id)
    {   
        $user = $this->getSessionUser($request);
        $kelas = Kelas::getByKodeKelas($kodeKelas);
        $tugas = Tugas::getByPenugasansId($id);
        if ($kelas == null) {
            return \abort(404, "Not Found");
        }

        $this->data['user'] = $user;
        $this->data['tugas'] = $tugas;
        $this->data['kelas'] = $kelas;
        return View::make('tugas.lihat', $this->data);
    }

    public function uploadPenugasan(Request $request, $kodeKelas){

        $file = $request->file('file');

        $penugasan = new Penugasan();
        $penugasan->fill(
            ['id_kelas' => $request->idKelas,
             'file' => $file->getClientOriginalName()
            ]
        );
        $penugasan->save();   
        $tujuan_upload = 'resource/kelas/'.$kodeKelas.'//Penugasan/'.$penugasan->id;
	    $file->move($tujuan_upload,$file->getClientOriginalName());
        
        return redirect()->back();
    }


    public function submitTugas(Request $request, $kodeKelas)
    {   
        $file = $request->file('file');

        DB::table('tugas')->insert([
            'nrp' => $request->nrp, 
            'penugasans_id' => $request->idTugas,
            'file' => $file->getClientOriginalName()
            ]);
        $tujuan_upload = 'resource/kelas/'.$kodeKelas.'//Tugas/'.$request->idTugas;
        $file->move($tujuan_upload,$file->getClientOriginalName());
        
        return redirect()->back();
    }
}
