<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crisis;

class CrisisController extends Controller
{
       public function detailsShow($id){

         $crisis = Crisis:: findorFail($id);

         return view ('frontend.pages.details', compact('crisis'));

       }
}
