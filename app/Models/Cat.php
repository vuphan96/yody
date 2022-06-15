<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\CatType;

class Cat extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'cat_id';
    public $timestamps = false;

    // lấy danh mục cat_type
    public function CatType(){
        return $this->belongsTo('App\Models\CatType','cat_type','id');
    }
    //lấy tất cả danh mục
    public function getItems(){
        return $this->get();
    }
    //tìm danh mục có id cho trước
    public function getItem($id){
        return $this->find($id);
    }
    public function getItemChill($id){
        return $this->where('parent_id',$id)->get();
    }
    public function getCats()
    {
        $categories = $this->orderBy('cat_id', 'DESC')->get();
        $listCats = [];
        $this->recurssive($categories, $parent = 0, $lever = 1, $listCats);
        return $listCats;

    }
    public function getCat($id)
    {
        $categories = $this->orderBy('cat_id', 'DESC')->where('cat_id','<>',$id)->get();
        $listCats = [];
        $this->recurssive($categories, $parent = 0, $lever = 1, $listCats);
        return $listCats;

    }
    // hàm đệ quy tất cả danh mục con để hiển thị
    public static function recurssive($categories, $parents = 0, $level = 1, &$listCat)
    {
        if (count($categories)>0) {
            foreach ($categories as $key => $value) {
                if ($value->parent_id == $parents) {
                    $value->level = $level;

                    $listCat[] = $value;

                    unset($categories[$key]);

                    $parent = $value->cat_id;
                    self::recurssive($categories, $parent, $level + 1, $listCat);

                }
            }
        }
    }
    //them danh mục
    public function getAdd($data){
        return $this->insert($data);
    }
    //chỉnh sủa danh mục
    public function getEdit($id, $data){
        return $this->where('cat_id',$id)->update($data);
    }
    //xóa danh mục
    public function getDel($id){
        return $this->destroy($id);
    }
    public function deleteChild($categories, $parent) {
        foreach($categories as $value) // lấy tất cả thành phần trong bảng category
        {
            if($value->parent_id == $parent){ // so sánh parent_id nào trong bảng cat bằng với id danh mục cần xóa
                // $oldpic = $value->picture; // lấy hình ảnh của danh mục cần xóa
                // if ($oldpic !='') {
                //     Storage::delete('public/files/'.$oldpic); // nếu có ảnh sẽ bị xóa khỏi thư mục
                // }
                $this->deleteChild($categories, $value->cat_id); // gọi lại hàm xóa danh mục con
                $this->destroy($value->cat_id); //nếu parent_id bằng với id danh mục cha bị xóa thì bị xóa theo

            }

        }
    }
}
