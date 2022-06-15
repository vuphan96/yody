<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = "news";
    protected $primaryKey = "news_id";
    const UPDATED_AT = null;

    public function Cat(){
        return $this->belongsTo('App\Models\Cat','cat_id','cat_id');
    }
    public function User(){
        return $this->belongsTo('App\Models\User','user_id','user_id');
    }
    public function getItems(){
        return $this->orderBy('news_id','DESC')->paginate(getenv('ROW_COUNT'));
    }
    public function getItem($id){
        return $this->find($id);
    }
    // Thêm sản phẩm
    public function getAdd($data){
        return $this->insert($data);
    }
    // chỉnh sửa sản phẩm
    public function getEdit($id,$data){
        return $this->where('news_id',$id)->update($data);
    }
    // xóa sản phẩm
    public function delItem($id){
        return $this->destroy($id);
    }
}
