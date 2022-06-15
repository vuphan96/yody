<?php

namespace App\Http\Controllers\Ayody;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Product;


class AyodyDetailController extends Controller
{
    public function __construct(Cat $cat,Product $product)
    {
        $this->cat = $cat;
        $this->product = $product;
    }
    public function shop($slug, $id){
        $objCats = $this->cat->getItemChill($id);
        return view('ayody.shop.shop',compact('objCats'));
    }
    public function detail($slug,$id){

        return view('ayody.detail.detail');
    }

}
