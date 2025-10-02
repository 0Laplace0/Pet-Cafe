<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    protected $table = 'tbl_banner';
    protected $primaryKey = 'id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['b_title', 'b_img'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false;
}