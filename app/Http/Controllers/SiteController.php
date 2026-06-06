<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Experience;
use App\Models\Skill;

class SiteController extends Controller
{
    public function index(){
        $account = Account::first(); 
        $projects = Project::active()->get();
        $testimonials = Testimonial::active()->get();
        $experiences = Experience::active()->get();
        $skills = Skill::active()->get();
        return view('frontend.index', compact('account', 'projects', 'testimonials', 'experiences', 'skills'));
    }
}
