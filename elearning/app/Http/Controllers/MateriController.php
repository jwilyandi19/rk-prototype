<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materi;
use App\Kelas;

class MateriController extends Controller
{

    private function getKelas($kodeKelas) {
        $kelas = new Kelas();
        $kelas->fill([
            'id' => 1,
            'kode_kelas' => $kodeKelas,
            'nama_kelas' => 'PAA',
            'id_pengajar' => 2,
            
        ]);
        return $kelas;
    }

    private function getMateri($kelasId,$materiId) {
        $materi = new Materi();
        $materi->fill([
            'id' => $materiId,
            'id_kelas' => $kelasId,
            'judul_materi' => 'Penting',
            'isi_materi' => 'Bumi itu datar'
        ]);
        return $materi;
    }

    private function getAllMateris($kelasId) {
        $materiList = [];
        $materi = new Materi();
        $materi1 = new Materi();
        $materi->fill([
            'id' => 1,
            'id_kelas' => $kelasId,
            'judul_materi' => 'Penting',
            'isi_materi' => 'Bumi itu datar'
        ]);
        $materi1->fill([
            'id' => 2,
            'id_kelas' => $kelasId,
            'judul_materi' => 'Penting',
            'isi_materi' => 'Bumi itu bulat'
        ]);
        array_push($materiList,$materi);
        array_push($materiList,$materi1);
        
        return $materiList;
    }

    public function index($kodeKelas) {
        $kelas = $this->getKelas($kodeKelas);
        $materis = $this->getAllMateris($kelas->getKey());
        return view('materi.home', compact('materis'));
        
    }

    public function view($kodeKelas,$idMateri) {
        $kelas = $this->getKelas($kodeKelas);
        $materi = $this->getMateri($kelas->getKey(),$idMateri);
        return view('materi.view', compact('materi'));
    }





}
