<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donar;

class DonarController extends Controller
{

 public function donarindex(){
    $donars=Donar::all();
    return view ('donar.donar',compact('donars'));
 }

 public function donarform(){
    return view ('donar.donarform');
 }


 public function donarsubmit(Request $request){
    Donar::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'address'=>$request->address

    ]);
    return redirect()->route('donar');
 }

}
