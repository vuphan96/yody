<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gelery extends Model
{
    use HasFactory;
    protected $table = "gelery";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function Product(){
        return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
    public function getItems(){
        return $this->orderBy('id','DESC')->paginate(getenv('ROW_COUNT'));
    }
    public function getItem($id){
        return $this->find($id);
    }
    public function getItempic($id){
        return $this->orderBy('id','DESC')->where('product_id',$id)->paginate(getenv('ROW_COUNT'));
    }
    // Thêm sản phẩm
    public function getAdd($data){
        return $this->insert($data);
    }
    // chỉnh sửa sản phẩm
    public function getEdit($id,$data){
        return $this->where('id',$id)->update($data);
    }
    // xóa sản phẩm
    public function delItem($id){
        $objgelery = $this->find($id);
        $oldpic = $objgelery->picture;
        if ($oldpic !='') {
            Storage::delete('public/files/'.$oldpic);
        }
        return $this->destroy($id);

    }
}
