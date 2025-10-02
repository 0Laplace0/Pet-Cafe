<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\PetModel; //model
use App\Models\FoodModel; //model
use Illuminate\Support\Facades\DB; //raw query (SQL)

use function PHPUnit\Framework\returnSelf;

class HomeController extends Controller
{

    public function index(){
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $pet = PetModel::orderBy('id', 'desc')->paginate(100); //order by & pagination
        $food = FoodModel::orderBy('id', 'desc')->paginate(100);
        DB::table('tbl_counter')->insert([['c_date' => now()]]); //บันทึกวันที่และเวลาปัจจุบัน

        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('home.home_index', compact('pet', 'food'));
    }

public function detail($id) {

        $pet = PetModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

        //ประกาศตัวแปรเพื่อส่งไปที่ view
        if (isset($pet)) {
            $id = $pet->id;
            $pet_name = $pet->pet_name;
            $pet_detail = $pet->pet_detail;
            $pet_type = $pet->pet_type;
            $pet_img = $pet->pet_img;
            $dateCreate = $pet->dateCreate;
            return view('home.pet_detail', compact('id', 'pet_name', 'pet_detail', 'pet_type', 'pet_img', 'dateCreate'));
        }else{
            return redirect('/');
        }
    } //func detail

public function searchProduct(Request $request) {

        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $keyword = $request->keyword;
        if(strlen($keyword) > 0){
            $pet = PetModel::where('pet_name', 'like', "%{$keyword}%")->paginate(8);
        }else{
            $pet = PetModel::orderBy('id', 'desc')->paginate(8);
        }
        return view('home.pet_index', compact('pet', 'keyword'));

    } //searchProduct


} //class
