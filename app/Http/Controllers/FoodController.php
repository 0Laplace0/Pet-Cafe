<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use Illuminate\Validation\Rule; //เช็คเงื่อนไข
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\FoodModel; //model
use Illuminate\Support\Facades\Auth; //session

class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        Paginator::useBootstrap();
        $FoodList = FoodModel::orderBy('id', 'desc')->paginate(6);
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('food.list', compact('FoodList'));
    }

    public function indexlist(){
        Paginator::useBootstrap();

        $savorydishes = FoodModel::where('food_type', 'SavoryDishes')
                    ->orderBy('id','desc')
                    ->paginate(100, ['*'], 'savorydishes_page');

        $appetizers = FoodModel::where('food_type', 'Appetizers')
                    ->orderBy('id','desc')
                    ->paginate(100, ['*'], 'appetizers_page');

        $desserts = FoodModel::where('food_type', 'Desserts')
                        ->orderBy('id','desc')
                        ->paginate(100, ['*'], 'desserts_page');

        $beverages = FoodModel::where('food_type', 'Beverages')
                        ->orderBy('id','desc')
                        ->paginate(100, ['*'], 'beverages_page');

        return view('menu_page.index', compact('savorydishes', 'appetizers', 'desserts', 'beverages'));
    }

    public function adding() {
        return view('food.create');
    }

    public function create(Request $request){
        // echo '<pre>';
        // dd($_POST);
        // exit();

        //msg
        $messages = [
            'food_name.required' => 'Please enter your pet name',
            'food_name.min' => 'Minimum :min letters',
            'food_name.unique' => 'This name already entered, please enter again',

            'food_detail.required' => 'Please enter your pet detail',
            'food_detail.min' => 'Minimum :min letters',

            'food_type.required' => 'Please enter your pet type',
            'food_type.in' => 'Please select type',

            'food_price.required' => 'Please enter your pet price',
            'food_price.integer' => 'Please enter numbers only',
            'food_price.min' => 'Minimum price more than 1',

            'food_img.mimes' => 'Only jpeg, png, jpg formats are supported!!',
            'food_img.max' => 'File size must not exceed 5MB!!',
        ];

        //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
        $validator = Validator::make($request->all(), [
            'food_name' => 'required|min:4|unique:tbl_foods',
            'food_detail' => 'required|min:10',
            'food_type' => ['required', Rule::in(['savorydishes', 'desserts', 'appetizers', 'beverages'])],
            'food_price' => 'required|integer|min:1',
            'food_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);
        

        //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
        if ($validator->fails()) {
            return redirect('food/adding')
                ->withErrors($validator)
                ->withInput();
        }


        //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/product
        try {
            $imagePath = null;
            if ($request->hasFile('food_img')) {
                $imagePath = $request->file('food_img')->store('uploads/food', 'public');
            }

            //insert เพิ่มข้อมูลลงตาราง
            FoodModel::create([
                'food_name' => strip_tags($request->food_name),
                'food_detail' => strip_tags($request->food_detail),
                'food_type' => $request->input('food_type'),
                'food_price' => $request->food_price,
                'food_img' => $imagePath,
            ]);

            //แสดง sweet alert
            Alert::success('Insert Successfully');
            return redirect('/food');

        } catch (\Exception $e) {  //error debug
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //create 

    public function edit($id){
        try {
            $food = FoodModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($food)) {
                $id = $food->id;
                $food_name = $food->food_name;
                $food_detail = $food->food_detail;
                $food_type = $food->food_type;
                $food_price = $food->food_price;
                $food_img = $food->food_img;
                return view('food.edit', compact('id', 'food_name', 'food_detail', 'food_type', 'food_price', 'food_img'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func edit

    public function update($id, Request $request){

        //error msg
        $messages = [
            'food_name.required' => 'Please enter your pet name',
            'food_name.min' => 'Minimum :min letters',

            'food_detail.required' => 'Please enter your pet detail',
            'food_detail.min' => 'Minimum :min letters',

            'food_type.required' => 'Please enter your pet type',
            'food_type.in' => 'Please select type',

            'food_price.required' => 'Please enter your pet price',
            'food_price.integer' => 'Please enter numbers only',
            'food_price.min' => 'Minimum price more than 1',

            'food_img.mimes' => 'Only jpeg, png, jpg formats are supported!!',
            'food_img.max' => 'File size must not exceed 5MB!!',
        ];

        //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
        $validator = Validator::make($request->all(), [
            'food_name' => 'required|min:4',
            'food_detail' => 'required|min:10',
            'food_type' => ['required', Rule::in(['savorydishes', 'desserts', 'appetizers', 'beverages'])],
            'food_price' => 'required|integer|min:1',
            'food_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);
        

        // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
        if ($validator->fails()) {
            return redirect('food/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
            $food = FoodModel::findOrFail($id);

            // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
            if ($request->hasFile('food_img')) {
                // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
                if ($food->food_img) {
                    Storage::disk('public')->delete($food->food_img);
                }
                // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/product' ใน disk 'public'
                $imagePath = $request->file('food_img')->store('uploads/food', 'public');
                // อัปเดต path รูปภาพใหม่ใน model
                $food->food_img = $imagePath;
            }

            // อัปเดตชื่อสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
            $food->food_name = strip_tags($request->food_name);
            // อัปเดตรายละเอียดสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
            $food->food_detail = strip_tags($request->food_detail);
            // อัปเดตประเภทอาหาร โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
            $food->food_type = $request->input('food_type');
            // อัปเดตราคาสินค้า
            $food->food_price = $request->food_price;

            // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
            $food->save();

            // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
            Alert::success('Update Successfully');

            // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
            return redirect('/food');

        } catch (\Exception $e) {
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //update

    public function remove($id){
        try {
            $food = FoodModel::find($id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

            if (!$food) {   //ถ้าไม่มี
                Alert::error('Pet not found.');
                return redirect('food');
            }

            //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
            if ($food->food_img && Storage::disk('public')->exists($food->food_img)) {
                Storage::disk('public')->delete($food->food_img);
            }

            // ลบข้อมูลจาก DB
            $food->delete();

            Alert::success('Delete Successfully');
            return redirect('food');

        } catch (\Exception $e) {
            Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
            return redirect('food');
        }
    } //remove 
} //class
