<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function userindex(){
        $users=User::all();

        return view ('user.user',compact('users'));
    }

    public function userform(){

       return view('user.userform');
    
    }

    public function usersubmit(Request $request){
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>$request->password,
            'role'=>$request->role,
            'address'=>$request->address,
            'image'=>$request->image,
            'status'=>$request->status

        ]);
        return redirect()->route('user');


    }
}
