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

        $fileName ='';
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = date('Ymdhis').$file->getClientOriginalName();
            $file->storeAs('/category', $fileName);

        }
      Category::create([
         'category_name'=>$request->category_name,
         'description'=>$request->description,
         'image'=>$fileName,
         'status'=>$request->status
      ]);
      return redirect()->route('crisis.category');
   }

   public function categoryview($id){

    $category= Category::find($id);

    return view('crisiscategory.categoryview',compact('category'));

   }
  // Show edit form
    public function edit($id) {

        $category = Category::findOrFail($id);

        return view('crisiscategory.edit', compact('category'));
        
    }

    public function update(Request $request, $id)
    { 
    $request->validate([
        'category_name' => 'required',
        'status' => 'required',
    ]);

    $category = Category::findOrFail($id);
    $category->category_name = $request->category_name;   
    $category->description = $request->description;
    $category->image = $request->image;
    $category->status = $request->status;
    $category->save();
     return redirect()->route('crisis.category')->with('success', 'Category updated!');
     
}


   public function categorydelete($id){

    $category=Category::find($id);
    $category->delete();
    return redirect()->back();
   }

}
