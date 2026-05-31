<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crisis;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Volunteer;

class WebCrisisController extends Controller
{
    public function crisisList(Request $request)
    {
        $query = Crisis::with('category')
                       ->withCount('donations')
                       ->where('status', 'active');
        $categories = Category::all();            

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('crisis_title', 'like', '%' . $request->search . '%');
        }

        $crises = $query->latest()->get()->map(function ($crisis) {
            $raised           = $crisis->raised_amount ?? 0; 
            $goal             = $crisis->target_amount ?? 0;
            $crisis->raised   = $raised;
            $crisis->goal     = $goal;
            $crisis->percent  = $goal > 0 ? min(100, ($raised / $goal) * 100) : 0;
            return $crisis;
        });

        return view('frontend.pages.crisislist', compact('crises', 'categories'));
    }

    public function detailsShow( int $id)
    {
        $crisis = Crisis::with('category')
                        ->withCount('donations')
                        ->findOrFail($id);

        $raised          = $crisis->raised_amount ?? 0; 
        $goal            = $crisis->target_amount ?? 0;
        $crisis->raised  = $raised;
        $crisis->goal    = $goal;
        $crisis->percent = $goal > 0 ? min(100, ($raised / $goal) * 100) : 0;
        $crisis->isFull  = $raised >= $goal && $goal > 0;
        
        $crisis->button_disabled = ($crisis->isFull || Auth::guest())? 'disabled' : '';
        $crisis->target_reached = $crisis->isFull ? 'Target Reached!' : 'Confirm Donation';

        return view('frontend.pages.details', compact('crisis'));
    }

    public function expenseShow(int $id)
    {
        $crisis = Crisis::findOrFail($id); 
        $expenses = Expense::with('volunteer')->where('crisis_id', $id)->get();
        $totalSpent = $expenses->where('status', 'approved')->sum('amount');
        $total = $expenses->sum('amount');
        return view('frontend.pages.expense-show', compact('crisis', 'expenses', 'totalSpent', 'total'));
    }
}