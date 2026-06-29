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

        // Tag this message with the token
        $data = $request->all();
        $data['session_token'] = $token;
        Contact::create($data);

        // Tag all existing messages with the same email so they share the same token
        Contact::where('email', $request->email)->where('session_token', '!=', $token)->update(['session_token' => $token]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
        }

        return back()->with('success', 'Message sent successfully!');
    }
}
