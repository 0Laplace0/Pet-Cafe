<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use Illuminate\Validation\Rule; //เช็คเงื่อนไข
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\BannerModel; //model

class BannerController extends Controller
{
    public function index(){
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $BannerList = BannerModel::orderBy('id', 'desc')->paginate(5); //order by & pagination
         //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('banner.list', compact('BannerList'));
    }

    public function adding() {
        return view('banner.create');
    }

    public function create(Request $request)
    {
        //msg
        $messages = [
            'b_title.required' => 'Please enter banner title',
            'b_title.min' => 'Minimum :min letters',

            'b_img.mimes' => 'Only jpeg, png, jpg formats are supported!!',
            'b_img.max' => 'File size must not exceed 5MB!!',
        ];

        //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
        $validator = Validator::make($request->all(), [
            'b_title' => 'required|min:4',
            'b_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);
        
        //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
        if ($validator->fails()) {
            return redirect('banner/adding')
                ->withErrors($validator)
                ->withInput();
        }

        //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/product
        try {
            $imagePath = null;
            if ($request->hasFile('b_img')) {
                $imagePath = $request->file('b_img')->store('uploads/banner', 'public');
            }

            //insert เพิ่มข้อมูลลงตาราง
            BannerModel::create([
                'b_title' => strip_tags($request->b_title),
                'b_img' => $imagePath,
            ]);

            //แสดง sweet alert
            Alert::success('Insert Successfully');
            return redirect('/banner');

        } catch (\Exception $e) {  //error debug
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //create 

    public function edit($id)
        {
            try {
                $banner = BannerModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

                //ประกาศตัวแปรเพื่อส่งไปที่ view
                if (isset($banner)) {
                    $id = $banner->id;
                    $b_title = $banner->b_title;
                    $b_img = $banner->b_img;
                    return view('banner.edit', compact('id', 'b_title', 'b_img'));
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
            'b_title.required' => 'Please enter banner title',
            'b_title.min' => 'Minimum :min letters',

            'b_img.mimes' => 'Only jpeg, png, jpg formats are supported!!',
            'b_img.max' => 'File size must not exceed 5MB!!',
        ];

        // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
        $validator = Validator::make($request->all(), [
            'b_title' => 'required|min:4',
            'b_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
        if ($validator->fails()) {
            return redirect('banner/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
            $banner = BannerModel::findOrFail($id);

            // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
            if ($request->hasFile('b_img')) {
                // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
                if ($banner->b_img) {
                    Storage::disk('public')->delete($banner->b_img);
                }
                // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/product' ใน disk 'public'
                $imagePath = $request->file('b_img')->store('uploads/banner', 'public');
                // อัปเดต path รูปภาพใหม่ใน model
                $banner->b_img = $imagePath;
            }

            // อัปเดตชื่อสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
            $banner->b_title = strip_tags($request->b_title);

            // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
            $banner->save();

            // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
            Alert::success('Update Successfully');

            // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
            return redirect('/banner');

        } catch (\Exception $e) {
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //update  



    public function remove($id)
    {
        try {
            $banner = BannerModel::find($id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

            if (!$banner) {   //ถ้าไม่มี
                Alert::error('Banner not found.');
                return redirect('banner');
            }

            //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
            if ($banner->b_img && Storage::disk('public')->exists($banner->b_img)) {
                Storage::disk('public')->delete($banner->b_img);
            }

            // ลบข้อมูลจาก DB
            $banner->delete();

            Alert::success('Delete Successfully');
            return redirect('banner');

        } catch (\Exception $e) {
            Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
            return redirect('banner');
        }
    } //remove 

}
