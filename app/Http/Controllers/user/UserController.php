<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class UserController extends Controller
{
     public function contactus(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $token = session('contact_token', bin2hex(random_bytes(16)));
        session(['contact_token' => $token]);

        // Tag this message with the session token (privacy: only this session can see it)
        $data = $request->all();
        $data['session_token'] = $token;
        Contact::create($data);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
        }

        return back()->with('success', 'Message sent successfully!');
    }
}
