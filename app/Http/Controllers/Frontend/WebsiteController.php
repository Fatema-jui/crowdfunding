<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Crisis;

class WebsiteController extends Controller
{
    public function websiteindex(){
        $categories = Category::get()->take(4);
        $crises = Crisis::latest()->where('status','active')->take(2)->get();

    return view ('frontend.pages.home',compact('categories','crises'));
    }



}
