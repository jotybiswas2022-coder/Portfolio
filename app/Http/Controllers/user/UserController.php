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

        // Reuse existing persistent token (generated on first page visit)
        $token = session('contact_token', bin2hex(random_bytes(16)));
        session(['contact_token' => $token]);

        $data = $request->all();
        $data['session_token'] = $token;
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }
        Contact::create($data);

        // Link old unlinked guest messages (same email) to this token
        Contact::where('email', $request->email)
            ->whereNull('user_id')
            ->whereNull('session_token')
            ->update(['session_token' => $token]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
        }

        return back()->with('success', 'Message sent successfully!');
    }
}
