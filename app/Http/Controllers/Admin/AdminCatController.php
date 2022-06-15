<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use Illuminate\Support\Facades\Storage;
use App\Models\CatType;

class AdminCatController extends Controller
{
    public function __construct(Cat $cat,Cattype $cattype)
    {
        $this->cat = $cat;
        $this->cattype = $cattype;
    }
    public function index(){
        $objCats = $this->cat->getItems();
        $showCats = $this->cat->getCats();
        return view('admin.cat.index',compact('objCats','showCats'));
    }
    // Them danh mục
    public function add(){
        $showCats = $this->cat->getCats();
        $objCattype = $this->cattype->getItems();
        return view('admin.cat.add',compact('showCats','objCattype'));
    }
    public function postadd(Request $request){
        // if($request->has('picture')){
        //     $tmp = $request->file('picture')->store('public/files');
        //     $tmp = explode('/',$tmp);
        //     $picture = end($tmp);
        // }
        $name = $request->nameCat;
        $parent = $request->parent;
        $catType = $request->catType;
        $arrcat = array(
            'cat_name'=>$name,
            'parent_id'=>$parent,
            'user_id'=>1,
            // 'picture'=>$picture,
            'cat_type'=>$catType
        );
        $objCat = $this->cat->getAdd($arrcat);
        // dd($arNews);
        if($objCat == true){
            return redirect()->Route('admin.cat.index')->with('msg','Thêm thành công');
        }else{
            return redirect()->Route('admin.cat.index')->with('msg','Đã có lỗi xảy ra');
        }
    }
    // chỉnh sửa danh mục
    public function edit($id){
        $objCat = $this->cat->getItem($id);
        $showCats = $this->cat->getCat($id);
        $objCattype = $this->cattype->getItems();
        return view('admin.cat.edit',compact('showCats','objCat','objCattype'));
    }
    public function postedit($id, Request $request){
        $objCat = $this->cat->getItem($id);
        // if($request->has('picture')){
        //     $tmp = $request->file('picture')->store('public/files');
        //     $tmp = explode('/',$tmp);
        //     $picture = end($tmp);
        //     $oldpic = $objCat->picture;
        //     if ($oldpic !='') {
        //         Storage::delete('public/files/'.$oldpic);
        //     }
        // }else{
        //     $picture = $objCat->picture;
        // }
        $name = $request->nameCat;
        $parent = $request->parent;
        $catType = $request->catType;
        $arrcat = array(
            'cat_name'=>$name,
            'parent_id'=>$parent,
            // 'picture'=>$picture,
            'cat_type'=>$catType
        );
        $objCat = $this->cat->getEdit($id,$arrcat);
        // dd($arNews);
        if($objCat == true){
            return redirect()->Route('admin.cat.index')->with('msg','chỉnh sửa thành công');
        }else{
            return redirect()->Route('admin.cat.index')->with('msg','Đã có lỗi xảy ra');
        }
    }
    public function delete($id){
        $objCats = $this->cat->getItems();
        $objCat = $this->cat->getItem($id);
        $result = $this->cat->getDel($id);
        // $oldpic = $objCat->picture;
        //     if ($oldpic !='') {
        //         Storage::delete('public/files/'.$oldpic);
        //     }
        $resultChild = $this->cat->deleteChild($objCats, $id);
        if($result == true && $resultChild==true){
            return redirect()->Route('admin.cat.index')->with('msg','xóa thành công');
        }else{
            return redirect()->Route('admin.cat.index')->with('msg','Đã có lỗi xảy ra');
        }
    }

}
