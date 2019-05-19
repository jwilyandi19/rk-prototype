<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Pengguna;
use Illuminate\Hashing\BcryptHasher;

class AuthController extends Controller
{
    public function registerIndex() {
        return \view('user.login');
    }

    public function register(Request $request) {
        $data = [];
        if($request->session()->has('userId')){
            return Redirect::to('/dashboard');
        }
        $pengguna = new Pengguna();
        if($request->has('nrp') && $request->has('password')){
            $pengguna->nrp = $request->post('nrp');
            $hasher = new BcryptHasher();
            $pengguna->password = $hasher->make($request->post('password'));
            $pengguna->save();
            $data['success'] = true;
        }
        
        return \view('user.register', $data);
    }
    
    
}
