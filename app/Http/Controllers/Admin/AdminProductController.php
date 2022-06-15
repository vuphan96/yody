<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function __construct(Product $product, Cat $cat, User $user)
    {
        $this->product = $product;
        $this->cat = $cat;
        $this->user = $user;
    }
    public function index (){
        $objProducts = $this->product->getItems();
        return view('admin.product.index',compact('objProducts'));
    }
    public function add(){
        $showCats = $this->cat->getCats();
        return view('admin.product.add',compact('showCats'));
    }
    public function postadd(Request $request){
        if($request->has('picture')){
            $tmp = $request->file('picture')->store('public/files');
            // $request->file('file')->store('public/files');
            $tmp = explode('/',$tmp);
            $picture = end($tmp);
        }
        // $idUser = Auth::user()->id;
        $data = array(
            'name'=>$request->name,
            'preview_text'=>$request->preview,
            'detail_text'=>$request->detail,
            'cat_id'=>$request->cat_id,
            'picture'=>$picture,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>0,
            'user_id'=>1
        );
        $result = $this->product->getAdd($data);
        // dd($arNews);
        if($result == true){
            return redirect()->route('admin.product.index')->with('msg','Thêm thành công');
        }else{
            return redirect()->Route('admin.product.index')->with('msg','Đã có lỗi xảy ra');
        }
    }
    public function edit ($id){
        $showCats = $this->cat->getCats();
        $objProduct = $this->product->getItem($id);
        // $idUserBlog = $objBlog->user_id;
        // echo $idUser;
        // $idUser = Auth::user()->id;
        // if ($idUserBlog == $idUser || $idUser == '1' || $idUser == '2') {
            // echo 'được phép truy cập';
            return view('Admin.product.edit',compact('showCats','objProduct'));
        // }else{
        //     return redirect()->Route('Admin.index.index')->with('msg','Bạn không được quyền thực hiện chức năng này');
        // }

    }
    public function postedit($id, Request $request){
        $objProduct = $this->product->getItem($id);
        if($request->has('picture')){
            $tmp = $request->file('picture')->store('public/files');
            // $request->file('file')->store('public/files');
            $tmp = explode('/',$tmp);
            $picture = end($tmp);
            $oldpic = $objProduct->picture;
            if ($oldpic !='') {
                Storage::delete('public/files/'.$oldpic);
            }
        }else{
            $picture = $objProduct->picture;
        }
        $data = array(
            'name'=>$request->name,
            'preview_text'=>$request->preview,
            'detail_text'=>$request->detail,
            'cat_id'=>$request->cat_id,
            'picture'=>$picture,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'status'=>$request->status,
            'user_id'=>1
        );
        $result = $this->product->getEdit($id,$data);
        if($result == true){
            return redirect()->route('admin.product.index')->with('msg','sửa thành công');
        }else{
            return redirect()->Route('admin.product.index')->with('msg','Đã có lỗi xảy ra');
        }

    }
    public function delete ($id){
        $objProduct = $this->product->getItem($id);
        // $idUserBlog = $objBlog->user_id;
        // $idUser = Auth::user()->id;
        // if ($idUserBlog == $idUser || $idUser == '1' || $idUser == '2') {

            $oldpic = $objProduct->picture;
            if ($oldpic !='') {
                Storage::delete('public/files/'.$oldpic);
            }
            $result = $this->product->delItem($id);
            if($result == true){
                return redirect()->Route('admin.product.index')->with('msg','Xóa thành công ');
            }else{
                return redirect()->Route('admin.product.index')->with('msg','Đã có lỗi xảy ra');
            }
        // }else{
        //     return redirect()->Route('Admin.index.index')->with('msg','Bạn không được quyền thực hiện chức năng này');
        // }

    }
}
