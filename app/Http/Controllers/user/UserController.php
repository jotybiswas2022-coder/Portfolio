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

        // Deterministic token from email + app key (same email = same token across sessions)
        $token = hash('sha256', $request->email . config('app.key'));
        session(['contact_token' => $token]);

        // Tag this message with the deterministic token
        $data = $request->all();
        $data['session_token'] = $token;
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }
        Contact::create($data);

        // Ensure all guest messages with this email share the same token
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
