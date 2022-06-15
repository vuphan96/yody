<?php

namespace App\Http\Controllers\Ayody;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AyodyCheckoutController extends Controller
{
    public function checkout(){
        return view('ayody.checkout.checkout');
    }
}
