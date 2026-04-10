<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Crisis;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::with('donors', 'crises');

        // Filter: From Date
        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        // Filter: To Date
        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Filter: Crisis
        if ($request->crisis_id) {
            $query->where('crisis_id', $request->crisis_id);
        }

        $donations = (clone $query)->latest()->paginate(10);

        $totalAmount = (clone $query)->sum('amount');
        $totalDonor = (clone $query)->count();

        $crisis = Crisis::all();

        return view('report.index', compact(
            'donations',
            'totalAmount',
            'totalDonor',
            'crisis'
        ));
    }
}

