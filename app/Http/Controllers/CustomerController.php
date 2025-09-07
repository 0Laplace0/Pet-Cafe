<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CustomerModel;
use Illuminate\Pagination\Paginator;

class CustomerController extends Controller
{

public function index()
{
    try {
        Paginator::useBootstrap();
        $CustomerList = CustomerModel::orderBy('id', 'desc')->paginate(10); //order by & pagination
        return view('customer.list', compact('CustomerList'));
    } catch (\Exception $e) {
       // \Log::error('Admin list error: '.$e->getMessage());
         return view('errors.404');
    }
}

    public function adding() {
        return view('customer.create');
    }

    public function create(Request $request)
    {
        // echo '<pre>';
        // dd($_POST);
        // exit();

        //vali msg 
        $messages = [
            'customer_fname.required' => 'Please enter your first name',
            'customer_fname.min' => 'Minimum :min letters',

            'customer_lname.required' => 'Please enter your last name',
            'customer_lname.min' => 'Minimum :min letters',

            'customer_email.required' => 'Please enter your email',
            'customer_email.email' => 'Please enter correct email',
            'customer_email.unique' => 'This email already entered, please enter again',

            'customer_password.required' => 'Please enter your password',
            'customer_password.min' => 'Minimum :min letters',

            'customer_tel.required' => 'Please enter your telephone',
            'customer_tel.min' => 'Minimum :min letters',
            'customer_tel.max' => 'Maximum :max letters',

            'customer_status.required' => 'Please select status',
            'customer_status.in' => 'Please select status',

        ];

        //rule 
        $validator = Validator::make($request->all(), [
            'customer_fname' => 'required|min:3',
            'customer_lname' => 'required|min:3',
            'customer_email' => 'required|email|unique:tbl_customer',
            'customer_password' => 'required|min:4',
            'customer_tel' => 'required|min:10|max:10',
            'customer_status' => ['required', Rule::in(['member', 'vip'])],
        ], $messages);

        //check vali 
        if ($validator->fails()) {
            return redirect('customer/adding')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            //ปลอดภัย: กัน XSS ที่มาจาก <script>, <img onerror=...> ได้
            CustomerModel::create([
                'customer_fname' => strip_tags($request->input('customer_fname')),
                'customer_lname' => strip_tags($request->input('customer_lname')),
                'customer_email' => strip_tags($request->input('customer_email')),
                'customer_password' => bcrypt($request->input('customer_password')),
                'customer_tel' => strip_tags($request->input('customer_tel')),
                'customer_status' => $request->input('customer_status'),
            ]);
            // แสดง Alert ก่อน return
            Alert::success('Add information success');
            return redirect('/customer');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun create



 public function edit($id)
    {
        try {
            //query data for form edit 
            $customer = CustomerModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($customer)) {
                $id = $customer->id;
                $customer_fname = $customer->customer_fname;
                $customer_lname = $customer->customer_lname;
                $customer_email = $customer->customer_email;
                $customer_tel = $customer->customer_tel;
                $customer_status = $customer->customer_status;
                return view('customer.edit', compact('id', 'customer_fname', 'customer_lname', 'customer_email', 'customer_tel', 'customer_status'));
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
            'customer_fname.required' => 'Please enter your first name',
            'customer_fname.min' => 'Minimum :min letters',

            'customer_lname.required' => 'Please enter your last name',
            'customer_lname.min' => 'Minimum :min letters',

            'customer_email.required' => 'Please enter your email',
            'customer_email.email' => 'Please enter correct email',
            'customer_email.unique' => 'This email already entered, please enter again',

            'customer_tel.required' => 'Please enter your telephone',
            'customer_tel.min' => 'Minimum :min letters',
            'customer_tel.max' => 'Maximum :max letters',

            'customer_status.required' => 'Please select status',
            'customer_status.in' => 'Please select status',
        ];

        //rule
        $validator = Validator::make($request->all(), [
            'customer_email' => [
                    'required',
                    'email',
                        Rule::unique('tbl_customer', 'customer_email')->ignore($id, 'id'), //ห้ามแก้ซ้ำ
            ],
            'customer_fname' => 'required|min:4',
            'customer_lname' => 'required|min:4',
            'customer_tel' => 'required|min:10|max:10',
            'customer_status' => ['required', Rule::in(['member', 'vip'])],
    ], $messages);

    //check 
        if ($validator->fails()) {
            return redirect('customer/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $customer = CustomerModel::find($id);
            $customer->update([
                    'customer_fname' => strip_tags($request->input('customer_fname')), //column update 
                    'customer_lname' => strip_tags($request->input('customer_lname')),
                    'customer_email' => strip_tags($request->input('customer_email')),
                    'customer_tel' => strip_tags($request->input('customer_tel')),
                    'customer_status' => $request->input('customer_status'),
                ]);
            // แสดง Alert ก่อน return
            Alert::success('Edit information success');
            return redirect('/customer');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun update 

    public function reset($id)
    {
        try {
            //query data for form edit 
            $customer = CustomerModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($customer)) {
                $id = $customer->id;
                $customer_fname = $customer->customer_fname;
                $customer_lname = $customer->customer_lname;
                $customer_email = $customer->customer_email;
                $customer_tel = $customer->customer_tel;
                $customer_status = $customer->customer_status;
                return view('customer.editPassword', compact('id', 'customer_fname', 'customer_lname', 'customer_email', 'customer_tel', 'customer_status'));
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
            return redirect('customer/reset/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $customer = CustomerModel::find($id);
            $customer->update([
                    'customer' => bcrypt($request->input('password')), //column update
                ]);
            // แสดง Alert ก่อน return
            Alert::success('Edit information success');
            return redirect('/customer');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun resetPassword 

    public function remove($id)
    {
        try {
            $customer = CustomerModel::find($id);  //query หาว่ามีไอดีนี้อยู่จริงไหม 
            $customer->delete();
            Alert::success('Delete information succes');
            return redirect('/customer');
        } catch (\Exception $e) {
            // return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //remove 


} //class
