<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = "size";
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
    public function getItemSize($id){
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
        return $this->destroy($id);
    }
}
