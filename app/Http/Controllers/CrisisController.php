<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Crisis;

class CrisisController extends Controller
{
    public function crisisindex(){
        $crises= Crisis::all();
        return view ('crisis.crisis',compact('crises'));
    }


    public function crisisform(){
        $categories=Category::all();
        return view ('crisis.crisisform',compact('categories'));
    }

    public function crisissubmit(Request $request){

       Crisis::create([
        'crisis_title'=>$request->crisis_title,
        'category_id'=>$request->category_id,
        'description'=>$request->description,
        'target_amount'=>$request->target_amount,
        'deadline_date'=>$request->deadline,
        'location'=>$request->location,
        'image'=>$request->image,
        'number'=>$request->number,
        'status'=>$request->status
       ]);
       return redirect()->route('crisis');

    }

    public function crisisview ($id){
        $crisis=Crisis::find($id);
        return view ('crisis.crisisview',compact('crisis'));
    }
}
