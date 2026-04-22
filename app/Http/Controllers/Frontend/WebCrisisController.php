<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crisis;
use App\Models\Category;

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

    // Crisis list page — নতুন add করো
    public function crisisList(Request $request)
    {
        $query = Crisis::with('category');

        // Category filter
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Search filter
        if ($request->search) {
            $query->where('crisis_title', 'like', '%' . $request->search . '%');
        }

        $crises     = $query->latest()->get();
        $categories = Category::all();

        return view('frontend.pages.crisislist', compact('crises', 'categories'));
    }
}

