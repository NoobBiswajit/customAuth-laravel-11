<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
     public function index(){
        return view('register');
    }

    public function registerProcess(Request $request){

        $validate=$request->validate([
            'name'=> 'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed'
        ]);

        if($validate=true){
            $user= new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();

            return redirect()->route('account.login')->with('success' ,'Registration Success');


        }else{
            return redirect()->route('account.register')->withInput()->withErrors( $validate);
        }
    }
}
