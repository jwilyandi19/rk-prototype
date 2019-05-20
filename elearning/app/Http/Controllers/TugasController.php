<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Tugas;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{   
    private function mockAllTugas($kelasId) {
        if(getenv('APP_DEBUG')){
            
            $tugas= [];
            for ($i=0; $i < 5; $i++) { 
                $tugas[$i] = new Tugas();
                $tugas[$i]->fill(
                    ['id' => $i,
                    'nrp' => 'nrp_'.$i,
                    'penugasans_id'=> 'penugasans_id'.$i]);
            }

            return $tugas;
        }else{
            //TODO : Connect Database
        }
    }

    public function index()
    {

    }

    public function getAllTugas(Request $request)
    {   
        $tugas= $this->mockAllTugas('kelas');
        return json_encode($tugas);
    }

    public function uploadPenugasan(Request $request){

        $file = $request->file('file');
        
        DB::table('penugasans')->insert(
            ['id_kelas' => $request->idKelas,
             'file' => $file->getClientOriginalName()
            ]);

        $tujuan_upload = 'Penugasan/'.$request->idKelas;
	    $file->move($tujuan_upload,$file->getClientOriginalName());
        
        return $request->idKelas;
    }

    public function submitTugas(Request $request)
    {   
        $file = $request->file('tugas');

        DB::table('penugasans')->insert(
            ['nrp' => $request->nrp, 'votes' => 0],
            ['penugasans_id' => $request->penugasansId, 'votes' => 0],
        );
    }
}
