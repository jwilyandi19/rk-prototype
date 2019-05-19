<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Pengguna;

class DashboardController extends UserController
{

    public function index(Request $request){
        if($request->session()->has('userId')){
            $user = $this->getSessionUser($request);
            if($user != null){
                return Redirect::to("/kelas");
            }
        }
        return Redirect::to('/login');
    }
}
