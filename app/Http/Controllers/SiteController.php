<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Profile;

class SiteController extends Controller
{
    public function index(){
        $account = Account::first(); 
        $donorsCount = Profile::count(); 
        return view('frontend.index', compact('account', 'donorsCount'));
    }

    public function donorList($bloodGroup = null){
    if($bloodGroup) {
        $donors = Profile::where('blood', $bloodGroup)->get();
    } else {
        $donors = Profile::all();
    }

    $sortedDonors = $donors->sortBy(function($donor) {
        if($donor->last_donated) {
            $nextDate = \Carbon\Carbon::parse($donor->nextDonationDate());
            $today = now()->startOfDay();
            return $today->diffInDays($nextDate, false);
        } else {
            return 0; // Eligible now -> top
        }
    });

    return view('frontend.donor_list', compact('donors', 'bloodGroup', 'sortedDonors'));
}
}
