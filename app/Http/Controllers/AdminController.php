<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\Volunteer;
use App\Models\Donation;


class AdminController extends Controller
{
    public function dashboardindex(){
        $totalDonor      = Donor::count();
        $totalVolunteer  = Volunteer::count();
        $totalDonation   = Donation::sum('amount');
        $recentDonations = Donation::latest()->take(5)->get();

        return view('admin.dashboard.dashboard', compact(
            'totalDonor',
            'totalVolunteer', 
            'totalDonation',
            'recentDonations'
        ));
        
    }
}
