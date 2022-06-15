<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\User;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function __construct(News $news, Cat $cat, User $user)
    {
        $this->news = $news;
        $this->cat = $cat;
        $this->user = $user;
    }
    public function index (){
        $objNews = $this->news->getItems();
        return view('admin.news.index',compact('objNews'));
    }
    public function add(){
        $showCats = $this->cat->getCats();
        return view('admin.news.add',compact('showCats'));
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
            'status'=>0,
            'user_id'=>1
        );
        $result = $this->news->getAdd($data);
        // dd($arNews);
        if($result == true){
            return redirect()->route('admin.news.index')->with('msg','Thêm thành công');
        }else{
            return redirect()->Route('admin.news.index')->with('msg','Đã có lỗi xảy ra');
        }
    }
    public function edit ($id){
        $showCats = $this->cat->getCats();
        $objNews = $this->news->getItem($id);
        // $idUserBlog = $objBlog->user_id;
        // echo $idUser;
        // $idUser = Auth::user()->id;
        // if ($idUserBlog == $idUser || $idUser == '1' || $idUser == '2') {
            // echo 'được phép truy cập';
            return view('Admin.news.edit',compact('showCats','objNews'));
        // }else{
        //     return redirect()->Route('Admin.index.index')->with('msg','Bạn không được quyền thực hiện chức năng này');
        // }

    }
    public function postedit($id, Request $request){
        $objNews = $this->news->getItem($id);
        if($request->has('picture')){
            $tmp = $request->file('picture')->store('public/files');
            // $request->file('file')->store('public/files');
            $tmp = explode('/',$tmp);
            $picture = end($tmp);
            $oldpic = $objNews->picture;
            if ($oldpic !='') {
                Storage::delete('public/files/'.$oldpic);
            }
        }else{
            $picture = $objNews->picture;
        }
        $data = array(
            'name'=>$request->name,
            'preview_text'=>$request->preview,
            'detail_text'=>$request->detail,
            'cat_id'=>$request->cat_id,
            'picture'=>$picture,
            'status'=>$request->status
        );
        $result = $this->news->getEdit($id,$data);
        if($result == true){
            return redirect()->route('admin.news.index')->with('msg','sửa thành công');
        }else{
            return redirect()->Route('admin.news.index')->with('msg','Đã có lỗi xảy ra');
        }

    }
    public function delete ($id){
        $objNews = $this->news->getItem($id);
        // $idUserBlog = $objBlog->user_id;
        // $idUser = Auth::user()->id;
        // if ($idUserBlog == $idUser || $idUser == '1' || $idUser == '2') {

            $oldpic = $objNews->picture;
            if ($oldpic !='') {
                Storage::delete('public/files/'.$oldpic);
            }
            $result = $this->news->delItem($id);
            if($result == true){
                return redirect()->Route('admin.news.index')->with('msg','Xóa thành công ');
            }else{
                return redirect()->Route('admin.news.index')->with('msg','Đã có lỗi xảy ra');
            }
        // }else{
        //     return redirect()->Route('Admin.index.index')->with('msg','Bạn không được quyền thực hiện chức năng này');
        // }

        }


}
