<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\StaffModel;
use Illuminate\Pagination\Paginator;

class StaffController extends Controller
{

public function index()
{
    try {
        Paginator::useBootstrap();
        $StaffList = StaffModel::orderBy('id', 'desc')->paginate(10); //order by & pagination
        return view('staff.list', compact('StaffList'));
    } catch (\Exception $e) {
       // \Log::error('Admin list error: '.$e->getMessage());
        return view('errors.404');
    }
}

    public function adding() {
        return view('staff.create');
    }

    public function create(Request $request)
    {
        // echo '<pre>';
        // dd($_POST);
        // exit();

        //vali msg 
        $messages = [
            'staff_fname.required' => 'Please enter your first name',
            'staff_fname.min' => 'Minimum :min letters',

            'staff_lname.required' => 'Please enter your last name',
            'staff_lname.min' => 'Minimum :min letters',

            'staff_tel.required' => 'Please enter your telephone',
            'staff_tel.min' => 'Minimum :min letters',
            'staff_tel.max' => 'Maximum :max letters',

            'staff_email.required' => 'Please enter your email',
            'staff_email.email' => 'Please enter correct email',
            'staff_email.unique' => 'This email already entered, please enter again',

            'staff_password.required' => 'Please enter your password',
            'staff_password.min' => 'Minimum :min letters',

            'staff_address.required' => 'Please enter your address',
            'staff_address.min' => 'Minimum :min letters',

            'staff_gender.required' => 'Please enter your',
            'staff_gender.min' => 'Minimum :min letters',

            'staff_position.required' => 'Please enter your position',
            'staff_position.min' => 'Minimum :min letters',
        ];

        //rule 
        $validator = Validator::make($request->all(), [
            'staff_email' => 'required|email|unique:tbl_staff',
            'staff_fname' => 'required|min:4',
            'staff_lname' => 'required|min:4',
            'staff_tel' => 'required|min:10|max:10',
            'staff_password' => 'required|min:4',
            'staff_address' => 'required|min:4',
            'staff_gender' => 'required|min:4',
            'staff_position' => 'required|min:4',
        ], $messages);

        //check vali 
        if ($validator->fails()) {
            return redirect('staff/adding')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            //ปลอดภัย: กัน XSS ที่มาจาก <script>, <img onerror=...> ได้
            StaffModel::create([
                'staff_fname' => strip_tags($request->input('staff_fname')),
                'staff_lname' => strip_tags($request->input('staff_lname')),
                'staff_tel' => strip_tags($request->input('staff_tel')),
                'staff_email' => strip_tags($request->input('staff_email')),
                'staff_password' => bcrypt($request->input('staff_password')),
                'staff_address' => strip_tags($request->input('staff_address')),
                'staff_gender' => strip_tags($request->input('staff_gender')),
                'staff_position' => strip_tags($request->input('staff_position')),
            ]);
            // แสดง Alert ก่อน return
            Alert::success('Add information success');
            return redirect('/staff');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //return view('errors.404');
        }
    } //fun create



 public function edit($id)
    {
        try {
            //query data for form edit 
            $staff = StaffModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($staff)) {
                $id = $staff->id;
                $staff_fname = $staff->staff_fname;
                $staff_lname = $staff->staff_lname;
                $staff_tel = $staff->staff_tel;
                $staff_email = $staff->staff_email;
                $staff_gender = $staff->staff_gender;
                $staff_address = $staff->staff_address;
                $staff_position = $staff->staff_position;
                return view('staff.edit', compact('id', 'staff_fname', 'staff_lname', 'staff_tel', 'staff_email', 'staff_gender', 'staff_address', 'staff_position'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func edit


 public function update($id, Request $request)
    {
        //vali msg 
        $messages = [
            'staff_fname.required' => 'Please enter your first name',
            'staff_fname.min' => 'Minimum :min letters',

            'staff_lname.required' => 'Please enter your last name',
            'staff_lname.min' => 'Minimum :min letters',

            'staff_tel.required' => 'Please enter your telephone',
            'staff_tel.min' => 'Minimum :min letters',
            'staff_tel.max' => 'Maximum :max letters',

            'staff_email.required' => 'Please enter your email',
            'staff_email.email' => 'Please enter correct email',
            'staff_email.unique' => 'This email already entered, please enter again',

            'staff_password.required' => 'Please enter your password',
            'staff_password.min' => 'Minimum :min letters',

            'staff_address.required' => 'Please enter your address',
            'staff_address.min' => 'Minimum :min letters',

            'staff_gender.required' => 'Please enter your',
            'staff_gender.min' => 'Minimum :min letters',

            'staff_position.required' => 'Please enter your position',
            'staff_position.min' => 'Minimum :min letters',
        ];

        //rule
        $validator = Validator::make($request->all(), [
            'staff_email' => [
                    'required',
                    'email',
                        Rule::unique('tbl_staff', 'staff_email')->ignore($id, 'id'), //ห้ามแก้ซ้ำ
            ],
    ], $messages);

    //check 
        if ($validator->fails()) {
            return redirect('staff/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $staff = StaffModel::find($id);
            $staff->update([
                'staff_fname' => strip_tags($request->input('staff_fname')),
                'staff_lname' => strip_tags($request->input('staff_lname')),
                'staff_tel' => strip_tags($request->input('staff_tel')),
                'staff_email' => strip_tags($request->input('staff_email')),
                'staff_password' => bcrypt($request->input('staff_password')),
                'staff_address' => strip_tags($request->input('staff_address')),
                'staff_gender' => strip_tags($request->input('staff_gender')),
                'staff_position' => strip_tags($request->input('staff_position')),
                ]);
            // แสดง Alert ก่อน return
            Alert::success('Edit information success');
            return redirect('/staff');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun update 


    public function remove($id)
    {
        try {
            $staff = StaffModel::find($id);  //query หาว่ามีไอดีนี้อยู่จริงไหม 
            $staff->delete();
            Alert::success('Delete information success');
            return redirect('/staff');
        } catch (\Exception $e) {
            // return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //remove 

    public function reset($id)
    {
        try {
            //query data for form edit 
            $staff = StaffModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($staff)) {
                $id = $staff->id;
                $staff_fname = $staff->staff_fname;
                $staff_lname = $staff->staff_lname;
                $staff_tel = $staff->staff_tel;
                $staff_email = $staff->staff_email;
                $staff_gender = $staff->staff_gender;
                $staff_address = $staff->staff_address;
                $staff_position = $staff->staff_position;
                return view('staff.editPassword', compact('id', 'staff_fname', 'staff_lname', 'staff_tel', 'staff_email', 'staff_gender', 'staff_address', 'staff_position'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //reset 

    public function resetPassword($id, Request $request) {
        //vali msg 
        $messages = [
            'password.required' => 'Please enter your password',
            'password.min' => 'Minimum :min letters',
            'password.confirmed' => 'Passwords do not match',

            'password_confirmation.required' => 'Please enter your confirm password',
            'password_confirmation.min' => 'Minimum :min letters',
        ];

        //rule
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
    ], $messages);

    //check 
        if ($validator->fails()) {
            return redirect('staff/reset/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $staff = StaffModel::find($id);
            $staff->update([
                    'staff' => bcrypt($request->input('password')), //column update
                ]);
            // แสดง Alert ก่อน return
            Alert::success('Edit information success');
            return redirect('/staff');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun resetPassword 


} //class
