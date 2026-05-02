<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Crisis;
use App\Models\Donation;
use App\Models\Volunteer;

class WebsiteController extends Controller
{
    public function websiteindex()
    {
        $categories = Category::take(4)->get();

        
        $crises = Crisis::with('category')
            ->withCount('donations')
            ->withSum('donations', 'amount')
            ->where('status', 'active')
            ->latest()
            ->get() 
            ->filter(function ($crisis) {
                $raised = $crisis->raised_amount ?? 0;
                $goal   = $crisis->target_amount ?? 0;
                
                
                return $goal <= 0 || $raised < $goal;
            })
            ->take(3) 
            ->map(function ($crisis) {
                $raised          = $crisis->raised_amount ?? 0;
                $goal            = $crisis->target_amount ?? 0;
                $crisis->raised  = $raised;
                $crisis->goal    = $goal;
                $crisis->percent = $goal > 0 ? min(100, ($raised / $goal) * 100) : 0;
                $crisis->isFull  = $goal > 0 && $raised >= $goal;
                return $crisis;
            });

        $totalDonated = Donation::sum('amount');
        $activeCrises = Crisis::where('status', 'active')->count();
        $volunteers   = Volunteer::count();

        return view('frontend.pages.home', compact(
            'categories',
            'crises',
            'totalDonated',
            'activeCrises',
            'volunteers'
        ));
    }
}




