<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Admin\Admin;
use Auth;
use Hash;

class LoginController extends Controller
{
    public function index()
    {
        return  view('admin/login');
    }
    public function admin_login(Request $request)
    {
        $this->validate($request,[
                'email' => 'required ',
                'password' => 'required'
            ]);
        $email = $request->input('email');
        $password =$request->input('password');


        $admin = Admin::where('email', $email)->first();
        if(@$admin->verified_status != '0')
        {
            
            if(Auth::guard('admin')->attempt(['email' => trim($email), 'password' => trim($password)]))
            {
                return redirect()->intended('admin/dashboard'); 
                //echo "Sucess";
            }
            else
            {
               return back()->with('info',' Username or  Password is incorrect');
            }
        }
        else
        {
            return back()->with('info',' Your Account is InActive');
        }
        

    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }


}
