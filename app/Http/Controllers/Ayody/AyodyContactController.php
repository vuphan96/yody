<?php

namespace App\Http\Controllers\Ayody;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AyodyContactController extends Controller
{
    public function contact(){
        return view('Ayody.contact.contact');
    }
}
