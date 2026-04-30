<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Crisis;
use App\Models\Volunteer;

class CrisisController extends Controller
{
    public function crisisindex(){
        $crises = Crisis::withSum('donations', 'amount')->get();  
        return view('crisis.crisis', compact('crises'));
    }

    public function crisisform(){
        $categories = Category::all();
        return view('crisis.crisisform', compact('categories'));
    }

    public function crisissubmit(Request $request){
        $fileName = '';
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = date('Ymdhis').$file->getClientOriginalName();
            $file->storeAs('/crises', $fileName);
        }

        Crisis::create([
            'crisis_title'  => $request->crisis_title,
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'target_amount' => $request->target_amount,
            'deadline_date' => $request->deadline,
            'location'      => $request->location,
            'image'         => $fileName,
            'number'        => $request->number,
            'status'        => $request->status
        ]);

        return redirect()->route('crisis');
    }

    public function crisisview($id){
        $crisis = Crisis::with('volunteers')->find($id);
        return view('crisis.crisisview', compact('crisis'));
    }

    public function edit($id)
    {
        $crisis = Crisis::findOrFail($id);
        // শুধু approved volunteer দেখাবে
        $volunteers = Volunteer::where('status', 'approved')->get();
        return view('crisis.edit', compact('crisis', 'volunteers'));
    }

    public function update(Request $request, $id)
    
    {
        //dd($request->all());
        $crisis = Crisis::findOrFail($id);

        $fileName = $crisis->image; // পুরানো image রাখবে
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = date('Ymdhis').$file->getClientOriginalName();
            $file->storeAs('/crises', $fileName);
        }

        $crisis->update([
            'crisis_title'  => $request->crisis_title,
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'target_amount' => $request->target_amount,
            'deadline_date' => $request->deadline_date,
            'location'      => $request->location,
            'image'         => $fileName,
            'number'        => $request->number,
            'status'        => $request->status,
        ]);

        // Multiple volunteers sync
        $crisis->volunteers()->sync($request->volunteer_ids ?? []);

        return redirect()->route('crisis')->with('success', 'Updated successfully');
    }

    public function crisisdelete($id){
        $crisis = Crisis::find($id);
        $crisis->delete();
        return redirect()->route('crisis')->with('success', 'Deleted successfully');
    }

    public function volunteerDelete($crisis_id, $volunteer_id)
    {
        $crisis = Crisis::findOrFail($crisis_id);
        $crisis->volunteers()->detach($volunteer_id);
    
        return redirect()->back()->with('success', 'Volunteer removed from crisis successfully.');
    }   
}