<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ReportController extends Controller
{
     public function index()
    {
        return view('report.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
        ]);

        $from_date = $request->from_date;
        $to_date   = $request->to_date;

        $expenses = Expense::with(['crisis', 'volunteer'])
            ->whereBetween('date', [$from_date, $to_date])
            ->get();

        $total    = $expenses->sum('amount');
        $approved = $expenses->where('status', 'approved')->count();
        $pending  = $expenses->where('status', 'pending')->count();

        return view('report.index', compact(
            'expenses', 'total', 'approved', 'pending',
            'from_date', 'to_date'
        ));
    }


    public function export(Request $request)
{
    $from_date = $request->from_date;
    $to_date   = $request->to_date;

    $expenses = Expense::with(['crisis', 'volunteer'])
        ->whereBetween('date', [$from_date, $to_date])
        ->get();

    $total = $expenses->sum('amount');

    return view('report.export', compact('expenses', 'total', 'from_date', 'to_date'));
    }

}
