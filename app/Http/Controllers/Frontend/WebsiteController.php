<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Crisis;
use App\Models\Donation;
use App\Models\volunteer;

class WebsiteController extends Controller
{
    public function websiteindex(){
    
        $categories = Category::take(4)->get();
        $crises = Crisis::with('category')
            ->withCount('donations')
            ->withSum('donations', 'amount')
            ->latest()
            ->where('status','active')
            ->take(3)
            ->get();

        $totalDonated = Donation::sum('amount');
        $activeCrises = Crisis::where('status', 'active')->count();
        $volunteers = volunteer::count();

        return view('frontend.pages.home', compact('categories','crises', 'totalDonated', 'activeCrises', 'volunteers'));
    }



}
