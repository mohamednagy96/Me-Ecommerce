<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }

    public function Login(LoginRequest $request){
        $remember_me=$request->has('remember_me') ? true : false ;
        if(auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            // notify()->success('تم الدخول بنجاح');
            return redirect()->route('admin.dashboard');
        }
            // notify()->error('حطا في البيانات برجاي المحاوله مجددا ');
            return redirect()->back()->with(['error'=>'هناك خطا بالبيانات']);

    }
}

//tinker
/*
$admin=App\Models\Admin();
$admin->name="mohamed";
$admin->email='mohamednagy9660@gmail.com';
$admin->password=bcrypt('123456789');
$admin->save();
*/