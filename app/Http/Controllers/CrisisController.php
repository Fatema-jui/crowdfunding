<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Crisis;
use App\Models\Volunteer;

class CrisisController extends Controller
{
    public function crisisindex(){
        $crises = Crisis::all();  
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


    public function crisisview( int $id){
        $crisis = Crisis::with('volunteers')->find($id);
        return view('crisis.crisisview', compact('crisis'));
    }


    
    public function volunteerAssign( int $id){

    $crisis = Crisis::findOrFail($id);

    
    $allVolunteers = Volunteer::all();

    
     $availableVolunteers = $allVolunteers->filter(function($volunteer) use ($id) {
        
        $isBusy = $volunteer->crises()
                            ->wherepivot('crisis_id', '!=', $id) 
                            ->wherePivot('status', '!=', 'completed')
                            ->exists();
        return !$isBusy; 
    });

    return view('crisis.volunteer_assign', compact('crisis', 'availableVolunteers'));
    }

    
    public function volunteerAssignStore(Request $request,int $id){

      $crisis = Crisis::findOrFail($id);
      $crisis->volunteers()->syncWithoutDetaching($request->volunteer_ids ?? []);

       return redirect()->route('crisis.view',['id'=>$id]);
     
    }


    public function edit(int $id)
    {
        $crisis = Crisis::findOrFail($id);
        return view('crisis.edit', compact('crisis'));
    }

    public function update(Request $request, int $id)
    
    {
        //dd($request->all());

        $request->validate([
        'crisis_title' => 'required',
        'status' => 'required',
    ]);
        $crisis = Crisis::findOrFail($id);

        $fileName = $crisis->image; 
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


        return redirect()->route('crisis');
    }



    public function crisisdelete( int $id){
        $crisis = Crisis::find($id);
        $crisis->delete();
        return redirect()->route('crisis');
    }



    public function volunteerDelete(int $crisis_id, int $volunteer_id)
    {
        $crisis = Crisis::findOrFail($crisis_id);
        $crisis->volunteers()->detach($volunteer_id);
    
        return redirect()->back();
    }   
}