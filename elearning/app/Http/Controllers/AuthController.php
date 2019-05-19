<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function login($id)
    {
        session_start();
        $_SESSION["id"] = $id;
    }

    public function logout()
    {
        session_destroy();

        return view('index');
    }
}
