<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Crisis;
use App\Models\Volunteer;          

class ExpenseController extends Controller
{
    public function expenseindex(){
        $expenses = Expense::with(['crisis', 'volunteer'])->get();
        return view ('expense.expense', compact('expenses'));
    }

    public function expenseform(Request $request){
        $crises = Crisis::all();

        if($request->crisis_id){

          $crisis = Crisis::with('volunteers')->find($request->crisis_id);
          $volunteers = $crisis->volunteers;
       } 

     else {
        $volunteers = collect();
          }
        return view('expense.expenseform', compact('crises', 'volunteers'));
    }

    public function expensesubmit(Request $request){
        $request->validate([
            'amount' => 'required|numeric',
            'purpose' => 'required|string',
            'crisis_id' => 'required|exists:crises,id',
            'volunteer_id' => 'required|exists:volunteers,id',
        ]);

        Expense::create([
            'volunteer_id' => $request->volunteer_id,
            'crisis_id' => $request->crisis_id,
            'purpose' => $request->purpose,
            'date' => $request->date,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('expense')->with('success', 'Expense added successfully.');
    }

    public function approve(int $id){
        $expense = Expense::findOrFail($id);
        $expense->status = 'approved';
        $expense->save();
    
        return redirect()->back()->with('success', 'Expense approved successfully.');
    }

    public function reject(int $id){
        $expense = Expense::findOrFail($id);
        $expense->status = 'rejected';
        $expense->save();

        return redirect()->back()->with('success', 'Expense rejected successfully.');
    }
}
