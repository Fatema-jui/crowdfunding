<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CrisisCategoryController extends Controller
{
    public function categoryindex(){
        $categories=Category::all();
        return view ('crisiscategory.category',compact('categories'));
    }
     
    public function categoryform(){
        return view('crisiscategory.categoryform');
    }

     public function categorysubmit(Request $request){
      Category::create([
         'category_name'=>$request->category_name,
         'description'=>$request->description,
         'status'=>$request->status
      ]);
      return redirect()->route('crisis.category');
   }

}
