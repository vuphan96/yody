<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gelery;
use Illuminate\Support\Facades\Storage;


class AdminGeleryController extends Controller
{
    public function __construct(Product $product, Gelery $gelery)
    {
        $this->product = $product;
        $this->gelery = $gelery;
    }
    public function add($id){
        $objGelerys = $this->gelery->getItempic($id);
        $objcount = $this->gelery->getItempic($id)->count();
        return view('admin.gelery.add',compact('objGelerys','id','objcount'));
    }
    public function postadd($id, Request $request){

        if ($request->hasFile('picture')) {
            foreach ($request->file('picture') as $index => $item) {
                $path = $request->picture[$index]->store('public/files');
                $tmp = explode('/',$path);
                $picture = end($tmp);
                $data = array(
                    'product_id'=>$id,
                    'picture'=>$picture
                );
                $result = $this->gelery->getAdd($data);
            }
            if($result == true){
                return redirect()->route('admin.gelery.add',['id'=>$id]);
            }
        }
    }
    public function delete($id, Request $request){
        $idPic = $request->idpic;
        $result = $this->gelery->delItem($idPic);
        $objGelerys = $this->gelery->getItempic($id);
        return view('admin.gelery.listPic',compact('objGelerys'));
    }

}
