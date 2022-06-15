<?php

namespace App\Http\Controllers\Ayody;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AyodyIndexController extends Controller
{
    public function index(){

        return view('ayody.index.index');
    }
}
