<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\UserModel; //model
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

public function index()
    {
        return view('auth.login');
    }

public function showRegister()
    {
        return view('auth.register');
    }

public function login(Request $request)
    {
        // Validate
        $request->validate([
            'user_email' => 'required|email|max:100',
            'user_password' => 'required'
        ], [
            'user_email.required' => 'กรุณาป้อน Email',
            'user_email.email' => 'Email ไม่ถูกต้อง',
            'user_password.required' => 'กรุณาป้อน password',
        ]);

        // Attempt to login
        if (Auth::guard('admin')->attempt([
            'user_email' => $request->user_email,
            'password' => $request->user_password,
        ])) {
            // Regenerate session ID for security
            $request->session()->regenerate();

            $u = Auth::guard('admin')->user();
            // Save email to session
            session()->put('user_email', $u->user_email);

            // Redirect to intended page or dashboard
            return redirect()->intended(
                strtolower((string)$u->user_role) === 'staff' ? '/dashboard' : '/'
            );
        }

        // If login fails, return with error
        Alert::error('เข้าสู่ระบบไม่สำเร็จ', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        return back()->withInput();
    }

public function register(Request $request)
    {
        $messages = [
            'user_name.required'        => 'Please enter your first name',
            'user_name.min'             => 'Minimum :min letters',

            'user_email.required'       => 'Please enter your email',
            'user_email.email'          => 'Please enter correct email',
            'user_email.unique'         => 'This email already entered, please enter again',

            'user_tel.required'         => 'Please enter your telephone',
            'user_tel.min'              => 'Minimum :min letters',
            'user_tel.max'              => 'Maximum :max letters',

            'user_password.required'    => 'Please enter your password',
            'user_password.min'         => 'Minimum :min letters',
            'user_password.confirmed'   => 'Passwords do not match',
        ];

        $validator = Validator::make($request->all(), [
            'user_name'      => 'required|min:4',
            'user_email'     => ['required','email',Rule::unique('tbl_user','user_email')],
            'user_tel'       => 'required|min:10|max:10',
            'user_password'  => 'required|min:4|confirmed',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = UserModel::create([
                'user_name'     => strip_tags($request->input('user_name')),
                'user_email'    => strip_tags($request->input('user_email')),
                'user_password' => bcrypt($request->input('user_password')),
                'user_tel'      => strip_tags($request->input('user_tel')),
                'user_role'     => 'member',
                'dateCreate'    => now(),
            ]);

            Auth::guard('admin')->login($user);
            $request->session()->regenerate();

            Alert::success('Register success', 'Welcome to Pet Cafe');
            return redirect('/');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }


public function logout(Request $request)
    {
        // logout
        Auth::logout();
        // ล้าง session ทิ้งทั้งหมด เพื่อความปลอดภัย
        $request->session()->invalidate();
        // สร้าง CRSF token ใหม่ เพื่อป้องกันการโจมตีแบบ CSRF
        $request->session()->regenerateToken();
        // เปลี่ยนเส้นทางไปหน้า home หลัง logout
        return redirect('/');
    } //logout
   
} //class