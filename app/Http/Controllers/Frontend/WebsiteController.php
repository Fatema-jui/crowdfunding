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

        // ✅ Logic controller এ — map() দিয়ে
        $crises = Crisis::with('category')
            ->withCount('donations')
            ->withSum('donations', 'amount')
            ->where('status', 'active')
            ->latest()
            ->get() // আগে সব আনুন
            ->filter(function ($crisis) {
                $raised = $crisis->donations_sum_amount ?? 0;
                $goal   = $crisis->target_amount ?? 0;
                
                // target পূরণ হয়নি এমনগুলো রাখবে
                return $goal <= 0 || $raised < $goal;
            })
            ->take(3) // filter এর পরে take করুন
            ->map(function ($crisis) {
                $raised          = $crisis->donations_sum_amount ?? 0;
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




