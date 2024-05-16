<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.AdminLogin');
    }

       public function authenticate(Request $request){

        $validate=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($validate=true){

            if(Auth::guard('admin')->attempt(['email'=>$request->email , 'password'=> $request->password])){

                if(Auth::guard('admin')->user()->role !="admin"){
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error','You ar not oAuthorize to Access');

                }else{
                    return redirect()->route('admin.dashboard');
                }



            }else{
                return redirect()->route('admin.login')->with('error','Either Email or password is incorrect');
            }

        }else{
            return redirect()->route('account.login')->withInput()->with($validate);
        }

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }


}
