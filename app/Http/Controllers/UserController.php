<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\UserModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Userland;

class UserController extends Controller
{

// public function __construct()
// {
//     $this->middleware('auth:admin');
// }

public function index()
{
    try {
        Paginator::useBootstrap();
        $userList = UserModel::orderBy('id', 'desc')->paginate(8); //order by & pagination
        return view('user.list', compact('userList'));
    } catch (\Exception $e) {
       // \Log::error('Admin list error: '.$e->getMessage());
        return view('errors.404');
    }
}

    public function adding() {
        return view('user.create');
    }

    public function create(Request $request)
    {
        // echo '<pre>';
        // dd($_POST);
        // exit();

        //vali msg 
        $messages = [
            'user_name.required' => 'Please enter your first name',
            'user_name.min' => 'Minimum :min letters',

            'user_password.required' => 'Please enter your password',
            'user_password.min' => 'Minimum :min letters',

            'user_email.required' => 'Please enter your email',
            'user_email.email' => 'Please enter correct email',
            'user_email.unique' => 'This email already entered, please enter again',

            'user_tel.required' => 'Please enter your telephone',
            'user_tel.min' => 'Minimum :min letters',
            'user_tel.max' => 'Maximum :max letters',

            'user_role.required' => 'Please enter your pet type',
            'user_role.in' => 'Please select type',
        ];

        //rule 
        $validator = Validator::make($request->all(), [
            'user_email' => 'required|email|unique:tbl_user',
            'user_name' => 'required|min:4',
            'user_password' => 'required|min:4',
            'user_tel' => 'required|min:10|max:10',
            'user_role' => ['required', Rule::in(['member', 'vip', 'staff'])],
        ], $messages);

        //check vali 
        if ($validator->fails()) {
            return redirect('user/adding')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            //ปลอดภัย: กัน XSS ที่มาจาก <script>, <img onerror=...> ได้
            UserModel::create([
                'user_name' => strip_tags($request->input('user_name')),
                'user_email' => strip_tags($request->input('user_email')),
                'user_password' => bcrypt($request->input('user_password')),
                'user_tel' => strip_tags($request->input('user_tel')),
                'user_role' => strip_tags($request->input('user_role')),
            ]);
            // แสดง Alert ก่อน return
            Alert::success('Add information success');
            return redirect('/user');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun create



 public function edit($id)
    {
        try {
            //query data for form edit 
            $user = UserModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($user)) {
                $id = $user->id;
                $user_name = $user->user_name;
                $user_email = $user->user_email;
                $user_password = $user->user_password;
                $user_tel = $user->user_tel;
                $user_role = $user->user_role;
                return view('user.edit', compact('id', 'user_name', 'user_email', 'user_password', 'user_tel', 'user_role'));
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
            'user_name.required' => 'Please enter your first name',
            'user_name.min' => 'Minimum :min letters',

            'user_password.required' => 'Please enter your password',
            'user_password.min' => 'Minimum :min letters',

            'user_email.required' => 'Please enter your email',
            'user_email.email' => 'Please enter correct email',
            'user_email.unique' => 'This email already entered, please enter again',

            'user_tel.required' => 'Please enter your telephone',
            'user_tel.min' => 'Minimum :min letters',
            'user_tel.max' => 'Maximum :max letters',

            'user_role.required' => 'Please enter your role',
            'user_role.in' => 'Please select role',
        ];

        //rule
        $validator = Validator::make($request->all(), [
            'user_email' => [
                    'required',
                    'email',
                        Rule::unique('tbl_user', 'user_email')->ignore($id, 'id'), //ห้ามแก้ซ้ำ
            ],
    ], $messages);

    //check 
        if ($validator->fails()) {
            return redirect('user/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user = UserModel::find($id);
            $user->update([
                'user_name' => strip_tags($request->input('user_name')),
                'user_email' => strip_tags($request->input('user_email')),
                'user_password' => bcrypt($request->input('user_password')),
                'user_tel' => strip_tags($request->input('user_tel')),
                'user_role' => strip_tags($request->input('user_role')),
                ]);
            // แสดง Alert ก่อน return
            Alert::success('Edit information success');
            return redirect('/user');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun update 


    public function remove($id)
    {
        try {
            $user = UserModel::find($id);  //query หาว่ามีไอดีนี้อยู่จริงไหม 
            $user->delete();
            Alert::success('Delete information success');
            return redirect('/user');
        } catch (\Exception $e) {
            // return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //remove 

    public function reset($id)
    {
        try {
            //query data for form edit 
            $user = UserModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($user)) {
                $id = $user->id;
                $user_name = $user->user_name;
                $user_email = $user->user_email;
                $user_password = $user->user_password;
                $user_tel = $user->user_tel;
                $user_role = $user->user_role;
                return view('user.editPassword', compact('id', 'user_name', 'user_email', 'user_password', 'user_tel', 'user_role'));
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
            return redirect('user/reset/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user = UserModel::find($id);
            $user->update([
                    'user' => bcrypt($request->input('password')), //column update
                ]);
            // แสดง Alert ก่อน return
            Alert::success('Edit information success');
            return redirect('/user');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun resetPassword 

} //class
