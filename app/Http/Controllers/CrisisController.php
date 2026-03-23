<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Crisis;

class CrisisController extends Controller
{
    public function crisisindex(){
        return view ('crisis.crisis');
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
        'target_amount'=>$request->amount,
        'deadline_date'=>$request->date,
        'location'=>$request->location,
        'image'=>$request->image,
        'number'=>$request->number,
        'status'=>$request->status
       ]);
       return redirect()->route('crisis');

    }
}
