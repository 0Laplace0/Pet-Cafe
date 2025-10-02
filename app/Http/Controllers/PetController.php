<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use Illuminate\Validation\Rule; //เช็คเงื่อนไข
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\PetModel; //model
use Illuminate\Support\Facades\Auth; //session

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        Paginator::useBootstrap();
        $PetList = PetModel::orderBy('id', 'desc')->paginate(6);
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('pet.list', compact('PetList'));
    }

    public function indexlist(){

        Paginator::useBootstrap();

        $dogs = PetModel::where('pet_type', 'Dog')
                    ->orderBy('id','desc')
                    ->paginate(100, ['*'], 'dogs_page');

        $cats = PetModel::where('pet_type', 'Cat')
                    ->orderBy('id','desc')
                    ->paginate(100, ['*'], 'cats_page');

        $raccoons = PetModel::where('pet_type', 'Raccoon')
                    ->orderBy('id','desc')
                    ->paginate(100, ['*'], 'raccoons_page');

        return view('pet_page.index', compact('dogs', 'cats', 'raccoons'));
    }

    public function dogs() {
        Paginator::useBootstrap();
        $dogs = PetModel::where('pet_type', 'Dog')
                ->orderBy('id','desc')
                ->paginate(100, ['*'], 'dogs_page');
        return view('pet_page.dogs', compact('dogs'));
    }

    public function cats() {
        Paginator::useBootstrap();
        $cats = PetModel::where('pet_type', 'Cat')
                ->orderBy('id','desc')
                ->paginate(100, ['*'], 'cats_page');
        return view('pet_page.cats', compact('cats'));
    }

    public function raccoons() {
        Paginator::useBootstrap();
        $raccoons = PetModel::where('pet_type', 'Raccoon')
                    ->orderBy('id','desc')
                    ->paginate(100, ['*'], 'raccoons_page');
        return view('pet_page.raccoons', compact('raccoons'));
    }

    public function adding() {
        return view('pet.create');
    }

public function create(Request $request)
{
    //msg
    $messages = [
        'pet_name.required' => 'Please enter your pet name',
        'pet_name.min' => 'Minimum :min letters',
        'pet_name.unique' => 'This name already entered, please enter again',

        'pet_detail.required' => 'Please enter your pet detail',
        'pet_detail.min' => 'Minimum :min letters',

        'pet_type.required' => 'Please enter your pet type',
        'pet_type.in' => 'Please select type',

        'pet_img.mimes' => 'Only jpeg, png, jpg formats are supported!!',
        'pet_img.max' => 'File size must not exceed 5MB!!',
    ];

    //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
    $validator = Validator::make($request->all(), [
        'pet_name' => 'required|min:4|unique:tbl_pets',
        'pet_detail' => 'required|min:10',
        'pet_type' => ['required', Rule::in(['dog', 'cat', 'raccoon'])],
        'pet_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ], $messages);
    

    //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
    if ($validator->fails()) {
        return redirect('pet/adding')
            ->withErrors($validator)
            ->withInput();
    }


    //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/product
    try {
        $imagePath = null;
        if ($request->hasFile('pet_img')) {
            $imagePath = $request->file('pet_img')->store('uploads/pet', 'public');
        }

        //insert เพิ่มข้อมูลลงตาราง
        PetModel::create([
            'pet_name' => strip_tags($request->pet_name),
            'pet_detail' => strip_tags($request->pet_detail),
            'pet_type' => $request->input('pet_type'),
            'pet_img' => $imagePath,
        ]);

        //แสดง sweet alert
        Alert::success('Insert Successfully');
        return redirect('/pet');

    } catch (\Exception $e) {  //error debug
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('errors.404');
    }
} //create 

public function edit($id)
    {
        try {
            $pet = PetModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($pet)) {
                $id = $pet->id;
                $pet_name = $pet->pet_name;
                $pet_detail = $pet->pet_detail;
                $pet_type = $pet->pet_type;
                $pet_img = $pet->pet_img;
                return view('pet.edit', compact('id', 'pet_name', 'pet_detail', 'pet_type', 'pet_img'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func edit

public function update($id, Request $request)
{

    //error msg
     $messages = [
        'pet_name.required' => 'Please enter your pet name',
        'pet_name.min' => 'Minimum :min letters',

        'pet_detail.required' => 'Please enter your pet detail',
        'pet_detail.min' => 'Minimum :min letters',

        'pet_type.required' => 'Please enter your pet type',
        'pet_type.in' => 'Please select type',

        'pet_img.mimes' => 'Only jpeg, png, jpg formats are supported!!',
        'pet_img.max' => 'File size must not exceed 5MB!!',
    ];


    // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
    $validator = Validator::make($request->all(), [
        'pet_name' => 'required|min:4',
        'pet_detail' => 'required|min:10',
        'pet_type' => ['required', Rule::in(['dog', 'cat', 'raccoon'])],
        'pet_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ], $messages);

    // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
    if ($validator->fails()) {
        return redirect('pet/' . $id)
            ->withErrors($validator)
            ->withInput();
    }

    try {
        // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
        $pet = PetModel::findOrFail($id);

        // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
        if ($request->hasFile('pet_img')) {
            // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
            if ($pet->pet_img) {
                Storage::disk('public')->delete($pet->pet_img);
            }
            // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/product' ใน disk 'public'
            $imagePath = $request->file('pet_img')->store('uploads/pet', 'public');
            // อัปเดต path รูปภาพใหม่ใน model
            $pet->pet_img = $imagePath;
        }

        // อัปเดตชื่อสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
        $pet->pet_name = strip_tags($request->pet_name);
        // อัปเดตรายละเอียดสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
        $pet->pet_detail = strip_tags($request->pet_detail);
        // อัปเดตประเภทสัตว์ โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
        $pet->pet_type = $request->input('pet_type');

        // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
        $pet->save();

        // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
        Alert::success('Update Successfully');

        // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
        return redirect('/pet');

    } catch (\Exception $e) {
       //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('errors.404');
    }
} //update  



public function remove($id)
{
    try {
        $pet = PetModel::find($id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

        if (!$pet) {   //ถ้าไม่มี
            Alert::error('Pet not found.');
            return redirect('pet');
        }

        //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
        if ($pet->pet_img && Storage::disk('public')->exists($pet->pet_img)) {
            Storage::disk('public')->delete($pet->pet_img);
        }

        // ลบข้อมูลจาก DB
        $pet->delete();

        Alert::success('Delete Successfully');
        return redirect('pet');

    } catch (\Exception $e) {
        Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
        return redirect('pet');
    }
} //remove 



} //class
