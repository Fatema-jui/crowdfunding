<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crisis;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Volunteer;

class WebCrisisController extends Controller
{
    public function crisisList(Request $request)
    {
        $query = Crisis::with('category')
                       ->withSum('donations', 'amount')
                       ->withCount('donations')
                       ->where('status', 'active');

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search filter
        if ($request->filled('search')) {
            $query->where('crisis_title', 'like', '%' . $request->search . '%');
        }

        // ✅ Logic সব controller এ — blade শুধু show করবে
        $crises = $query->latest()->get()->map(function ($crisis) {
            $raised           = $crisis->donations_sum_amount ?? 0;
            $goal             = $crisis->target_amount ?? 0;
            $crisis->raised   = $raised;
            $crisis->goal     = $goal;
            $crisis->percent  = $goal > 0 ? min(100, ($raised / $goal) * 100) : 0;
            return $crisis;
        });

        $categories = Category::all();

        return view('frontend.pages.crisislist', compact('crises', 'categories'));
    }

    public function detailsShow($id)
    {
        $crisis = Crisis::with('category')
                        ->withCount('donations')
                        ->withSum('donations', 'amount')
                        ->findOrFail($id);

        // ✅ Details page এও logic controller এ
        $raised          = $crisis->donations_sum_amount ?? 0;
        $goal            = $crisis->target_amount ?? 0;
        $crisis->raised  = $raised;
        $crisis->goal    = $goal;
        $crisis->percent = $goal > 0 ? min(100, ($raised / $goal) * 100) : 0;
        $crisis->isFull  = $raised >= $goal && $goal > 0;

        return view('frontend.pages.details', compact('crisis'));
    }

   public function expenseShow($id){

    $crisis = Crisis::withSum('donations', 'amount')->findOrFail($id);
    $expenses = Expense::with('volunteer')->where('crisis_id', $id)->get();
    $totalSpent = $expenses->where('status', 'approved')->sum('amount');
    return view('frontend.pages.expense-show', compact('crisis', 'expenses', 'totalSpent'));
     
    }
}

