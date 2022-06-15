<?php

namespace App\Http\Controllers\Ayody;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AyodyLoginController extends Controller
{
    public function login(){
        return view('ayody.login.login');
    }
}
