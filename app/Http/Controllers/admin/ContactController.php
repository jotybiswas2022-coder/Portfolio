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

        // Create a child record so user sees it in My Messages
        Contact::create([
            'parent_id' => $contact->id,
            'name' => 'Admin',
            'email' => $contact->email,
            'message' => $request->reply,
            'type' => 'reply',
        ]);

        return back()->with('success', 'Reply sent successfully!');
    }
}
