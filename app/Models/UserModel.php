<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Authenticatable
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id';
    protected $fillable = ['user_name', 'user_password', 'user_email', 'user_tel', 'user_role', 'dateCreate'];
    public $incrementing = true;
    public $timestamps = false;

   public function getAuthPassword()
   {
       return $this->user_password;
   }
}