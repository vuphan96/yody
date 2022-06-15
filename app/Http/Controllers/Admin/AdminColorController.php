<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;

class AdminColorController extends Controller
{
    public function __construct(Product $product, Color $color)
    {
        $this->product = $product;
        $this->color = $color;
    }
    public function add($id){
        $objColors = $this->color->getItempic($id);
        return view('admin.color.add',compact('objColors','id'));
    }
    public function postadd($id, Request $request){

        if ($request->hasFile('picture')) {
            if($request->has('picture')){
                $tmp = $request->file('picture')->store('public/files');
                // $request->file('file')->store('public/files');
                $tmp = explode('/',$tmp);
                $picture = end($tmp);
            }
            $nameColor = $request->namecolor;
            $codecolor = $request->codecolor;
            $data = array(
                'product_id'=>$id,
                'picture'=>$picture,
                'name' => $nameColor,
                'color_code'=>$codecolor
            );
            $result = $this->color->getAdd($data);
            if($result == true){
                return redirect()->route('admin.color.add',['id'=>$id]);
            }
        }
    }
    public function delete($id, Request $request){
        $idPic = $request->idpic;
        $result = $this->color->delItem($idPic);
        $objColors = $this->color->getItempic($id);
        return view('admin.color.listColor',compact('objColors'));
    }
}
