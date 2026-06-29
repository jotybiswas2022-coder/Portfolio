<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    function index(){
        $contacts = Contact::latest()->get();
        return view('backend.contact.index', compact('contacts'));
    }

    function reply(Request $request, $id){
        $request->validate([
            'reply' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update([
            'reply' => $request->reply,
            'replied_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Reply sent successfully!');
    }
}
