<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Service;
use App\Models\Faq;
use App\Models\CaseStudy;
use App\Models\Gig;

class SiteController extends Controller
{
    public function index(){
        $account = Account::first(); 
        $projects = Project::active()->get();
        $testimonials = Testimonial::active()->get();
        $experiences = Experience::active()->get();
        $skills = Skill::active()->get();
        $services = Service::active()->get();
        $faqs = Faq::active()->get();
        $caseStudies = CaseStudy::active()->get();
        $gigs = Gig::active()->get();
        return view('frontend.index', compact('account', 'projects', 'testimonials', 'experiences', 'skills', 'services', 'faqs', 'caseStudies', 'gigs'));
    }

    public function gigDetail($id){
        $gig = Gig::findOrFail($id);
        return view('frontend.gig-detail', compact('gig'));
    }

    public function caseStudyDetail($id){
        $caseStudy = CaseStudy::findOrFail($id);
        return view('frontend.case-study-detail', compact('caseStudy'));
    }
}
