<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $primaryKey = 'contact_id';
    public $timestamps = false;

    public function getItems(){
        return $this->orderBy('contact_id','DESC')->paginate(getenv('ROW_COUNT'));
    }
    // xóa liên hệ
    public function delItem($id){
        return $this->destroy($id);
    }
}
