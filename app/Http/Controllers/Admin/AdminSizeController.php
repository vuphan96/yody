<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;

class AdminSizeController extends Controller
{
    public function __construct(Product $product, Size $size)
    {
        $this->product = $product;
        $this->size = $size;
    }
    public function add($id){
        $objSizes = $this->size->getItemSize($id);
        return view('admin.size.add',compact('objSizes','id'));
    }
    public function postadd($id, Request $request){
        $data = array(
            'product_id'=>$id,
            'size_name'=>$request->namesize

        );
        $result = $this->size->getAdd($data);
        if($result == true){
            return redirect()->route('admin.size.add',['id'=>$id]);
        }
    }
    public function delete($id, Request $request){
        $idPic = $request->idpic;
        $result = $this->size->delItem($idPic);
        $objSizes = $this->size->getItemSize($id);
        return view('admin.size.listSize',compact('objSizes'));
    }
}
