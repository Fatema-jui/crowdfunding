<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        'name'     => $request->name,
        'email'    => $request->email,
        'phone'    => $request->phone,
        'password' => Hash::make($request->password),  
        'role'     => $request->role ?? 'user',        
        
    ]);
    return redirect()->route('user');
      
    }

    public function userview($id){
        $user=User::findOrFail($id);
        return view('user.userview',compact('user'));
    }

    public function useredit($id){
        $user=User::findOrFail($id);
        return view('user.useredit',compact('user'));
    }

    public function userupdate(Request $request,$id){
        $user=User::findOrFail($id);
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,  
            'role'     => $request->role ?? 'user', 
        ]);
        return redirect()->route('user');
    }

    public function userdelete($id){
       $users = User::findOrFail($id);
       
       $users->delete();

        return redirect()->back();
    }

}
     