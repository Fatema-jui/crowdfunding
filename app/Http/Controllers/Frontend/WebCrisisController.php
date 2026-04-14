<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crisis;

class WebCrisisController extends Controller
{
    public function detailsShow($id)
    {
        $crisis = Crisis::with('category')
            ->withCount('donations')
            ->withSum('donations', 'amount')
            ->findOrFail($id);

        return view('frontend.pages.details', compact('crisis'));
    }
}
