<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatType extends Model
{
    use HasFactory;
    protected $table = "cat_type";
    protected $primaryKey = "id";
    public $timestamps = false;

    // lấy danh sách cat_type
    public function getItems(){
        return $this->get();
    }

}
