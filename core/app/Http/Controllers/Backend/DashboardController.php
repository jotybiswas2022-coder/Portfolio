<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        $contacts = Contact::latest()->take(10)->get();
        return view('backend.index', compact('contacts'));
    }

    /**
     * Show all contact messages.
     */
    public function contact()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('backend.contact.index', compact('contacts'));
    }
}
