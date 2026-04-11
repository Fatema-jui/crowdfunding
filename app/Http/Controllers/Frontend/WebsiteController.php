<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class WebsiteController extends Controller
{
    public function websiteindex(){
        $categories=Category::get()->take(4);

    return view ('frontend.pages.home',compact('categories'));
    }



}
