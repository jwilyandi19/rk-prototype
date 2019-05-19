<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;
use Illuminate\Hashing\BcryptHasher;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('index');
    }

    public function login(Request $request)
    {   
        $nrp = $request->post('nrp');
        $password = $request->post('password');
        $pengguna = Pengguna::where('nrp','=', $nrp)->get();

        $hasher = new BcryptHasher();
        if($hasher->check($request->post('password'), $pengguna->password)){
            $request->session()->put('UserId', $pengguna->id);
        }
        else {
            return view('index');
        }

    }

    public function logout(Request $request)
    {   
        $request->session()->flush();
        return view('index');
    }
}
