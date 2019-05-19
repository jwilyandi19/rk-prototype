<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Pengguna;
use Illuminate\Hashing\BcryptHasher;
use TheSeer\Tokenizer\Exception;

class AuthController extends Controller
{

    private $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function login(Request $request) {
        return \view('auth.login', $this->data);
    }

    public function doLogin(Request $request)
    {   
        if($request->has(['nrp','password'])){
            $nrp = $request->post('nrp');
            $password = $request->post('password');
            $pengguna = Pengguna::getByNrp($nrp);
            if($pengguna != null){
                $hasher = new BcryptHasher();
                if($hasher->check($password, $pengguna->password)){
                    $request->session()->put('userId', $pengguna->id);
                    return Redirect::to("/");
                }
            }
        }
        $this->data['error'] = 'Kombinasi NRP dan Password tidak ditemukan!';
        return $this->login($request);
    }

    public function logout(Request $request)
    {   
        $request->session()->flush();
        return view('auth.login');
    }
    
    public function register(Request $request) {
        return \view('auth.register', $this->data);
    }

    public function doRegister(Request $request) {
        if($request->has('nrp') && $request->has('password')){
            $pengguna = Pengguna::getByNrp($request->post('nrp'));
            if($pengguna == null){
                $hasher = new BcryptHasher();
                $pengguna = new Pengguna();
                $pengguna->setAttribute('nrp', $request->post('nrp'));
                $pengguna->setAttribute('password', $hasher->make($request->post('password')));
                $pengguna->save();
                $this->data['success'] = 'Akun telah berhasil terbuat!';
            }else{
                $this->data['error'] = 'NRP sudah pernah digunakan!';
            }
        }
        return $this->register($request);
    }
    
    
}
