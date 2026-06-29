<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }
        Contact::create($data);

        // Link existing guest messages (same email) to this session so user sees them too
        Contact::where('email', $request->email)
            ->whereNull('user_id')
            ->where('session_token', '!=', $token)
            ->update(['session_token' => $token]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
        }

        return back()->with('success', 'Message sent successfully!');
    }
}
