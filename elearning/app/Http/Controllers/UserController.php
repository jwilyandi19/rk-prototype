<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;

abstract class UserController extends Controller
{

    /**
     * Hold references for data to be passed for view
     *
     * @var mixed
     */
    protected $data;
    /**
     * Hold reference to user
     *
     * @var Pengguna
     */
    private $user;

    /**
     * Get User from Session
     *
     * @param \Illuminate\Http\Request $request
     * @return Pengguna
     */
    public function getSessionUser(Request $request) {
        if($this->user != null){
            return $this->user;
        }
        $user = null;
        if($request->session()->has('userId')){
            $userId = $request->session()->get('userId');
            $user = Pengguna::getById($userId);
            if($user != null){
                $this->user = $user;
                $this->data['user'] = $user;
                return $user;
            }
            $request->session()->flush();
        }
        return $user;
    }
}
