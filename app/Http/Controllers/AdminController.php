<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(){
        return view('admin.parts.index');
    }

    public function doLogin(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
//            notify()->success('Welcome Back','Success');
            alert()->success('مرحبا بك','تم تسجيل الدخول بنجاح');
            return redirect()->route('admin.home');
        }
//        notify()->error('Wrong Credentials','Error');
        alert()->error('خطأ','البيانات المدخلة غير صحيحة');
        return redirect()->back();
    }

    public function logout(){
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }


}

