<?php

namespace App\Http\Controllers\Ayody;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AyodyCartController extends Controller
{
    public function cart(){
        return view('Ayody.cart.cart');
    }
}
