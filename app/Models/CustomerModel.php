<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = 'tbl_customer';
    protected $primaryKey = 'id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['customer_fname', 'customer_lname', 'customer_password', 'customer_email', 'customer_tel', 'customer_status', 'dateCreate'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false;
}
