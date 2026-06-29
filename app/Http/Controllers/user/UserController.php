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

        // Generate a fresh random token for each submission (true privacy)
        $token = bin2hex(random_bytes(16));
        session(['contact_token' => $token]);

        $data = $request->all();
        $data['session_token'] = $token;
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }
        Contact::create($data);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
        }

        return back()->with('success', 'Message sent successfully!');
    }
}
