<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class MyMessageController extends Controller
{
    function fetch(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $messages = Contact::root()
            ->where('email', $request->email)
            ->where('type', 'message')
            ->latest()
            ->with(['replies' => function ($q) {
                $q->orderBy('created_at');
            }])
            ->get()
            ->map(function ($msg) {
                $msg->thread = collect([$msg])->concat($msg->replies);
                return $msg;
            });

        return response()->json(['success' => true, 'messages' => $messages]);
    }

    function reply(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|exists:contacts,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $parent = Contact::findOrFail($request->parent_id);

        if ($parent->email !== $request->email) {
            return response()->json(['success' => false, 'message' => 'Email does not match.'], 403);
        }

        $reply = Contact::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'type' => 'follow_up',
        ]);

        return response()->json(['success' => true, 'reply' => $reply]);
    }
}
