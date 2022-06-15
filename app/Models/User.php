<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'fullname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = "user";
    protected $primaryKey = "user_id";
    public $timestamps = false;

    public function getItems(){
        return $this->orderBy('user_id','DESC')->paginate(getenv('ROW_COUNT'));
    }
    public function getcounts(){
        return $this->all()->count();
    }
    public function getAdd($data){
        return $this->insert($data);
    }
    public function getItem($id){
        return $this->find($id);
    }
    public function getEdit($id,$data){
        return $this->where('user_id',$id)->update($data);
    }
    public function getDel($id){
        return $this->destroy($id);
    }
    public function getMail($email){
        return $this->where('email','like','%'.$email.'%')->get();
    }
    public function getpass($email,$data){
        return $this->where('email','like','%'.$email.'%')->update($data);
    }
    public function getUsername($username){
        return $this->where('username','like','%'.$username.'%')->get();
    }
    public function getLookUser($username,$data){
        return $this->where('username','like','%'.$username.'%')->update($data);
    }
}
