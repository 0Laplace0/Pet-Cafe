<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetModel extends Model
{
    protected $table = 'tbl_pets';
    protected $primaryKey = 'id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['pet_name', 'pet_detail', 'pet_type', 'pet_img', 'dateCreate'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false; // ใส่บรรทัดนี้ถ้าไม่มี created_at, updated_at
}



