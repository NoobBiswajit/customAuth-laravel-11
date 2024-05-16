<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }


    public function authenticate(Request $request){

        $validate=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($validate=true){

            if(Auth::attempt(['email'=>$request->email , 'password'=> $request->password])){

                return redirect()->route('account.dashboard');

            }else{
                return redirect()->route('account.login')->with('error','Either Email or password is incorrect');
            }

        }else{
            return redirect()->route('account.login')->withInput()->with($validate);
        }

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');

    }
}
