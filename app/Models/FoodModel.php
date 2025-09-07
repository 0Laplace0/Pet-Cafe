<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodModel extends Model
{
    protected $table = 'tbl_foods';
    protected $primaryKey = 'id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['food_name', 'food_detail', 'food_type', 'food_price', 'food_img', 'dateCreate'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false; // ใส่บรรทัดนี้ถ้าไม่มี created_at, updated_at
}



