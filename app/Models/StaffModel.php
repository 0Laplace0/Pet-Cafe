<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    protected $table = 'tbl_staff';
    protected $primaryKey = 'id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['staff_fname', 'staff_lname', 'staff_tel', 'staff_email', 'staff_password', 'staff_gender', 'staff_address', 'staff_position', 'dateCreate'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false;
}
