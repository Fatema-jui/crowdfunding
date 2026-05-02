<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\Volunteer;
use App\Models\Donation;
use App\Models\Crisis;
use App\Models\User;
use App\Models\Category;



class AdminController extends Controller
{
    public function dashboardindex(){
        $totalDonor      = Donor::count();
        $totalVolunteer  = Volunteer::count();
        $totalDonation   = Donation::sum('amount');
        $totalCrisis     = Crisis::count();
        $totalUser       = User::count();
        $totalCategory   = Category::count();
        

        return view('admin.dashboard.dashboard', compact(
            'totalDonor',
            'totalVolunteer', 
            'totalDonation',
            'totalCrisis',
            'totalUser',
            'totalCategory',
            
        ));
        
    }
}
