<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class MyMessageController extends Controller
{
    function checkSession()
    {
        $hasToken = session()->has('contact_token');
        return response()->json(['hasSession' => $hasToken || Auth::check()]);
    }

    function fetch(Request $request)
    {
        if (Auth::check()) {
            // Logged-in user: see all messages linked to their account
            $rows = Contact::root()
                ->where('user_id', Auth::id())
                ->where('type', 'message')
                ->latest()
                ->with(['replies' => function ($q) {
                    $q->orderBy('created_at');
                }])
                ->get();
        } else {
            // Guest: only see messages from this session
            $token = session('contact_token');
            if (!$token) {
                return response()->json(['success' => false, 'messages' => []]);
            }

            $rows = Contact::root()
                ->where('session_token', $token)
                ->where('type', 'message')
                ->latest()
                ->with(['replies' => function ($q) {
                    $q->orderBy('created_at');
                }])
                ->get();
        }

        $messages = $rows->map(function ($msg) {
            $thread = collect([$msg])->concat($msg->replies);
            return [
                'id'         => $msg->id,
                'name'       => $msg->name,
                'email'      => $msg->email,
                'message'    => $msg->message,
                'type'       => $msg->type,
                'parent_id'  => $msg->parent_id,
                'created_at' => $msg->created_at,
                'updated_at' => $msg->updated_at,
                'thread'     => $thread->map(function ($t) {
                    return [
                        'id'         => $t->id,
                        'name'       => $t->name,
                        'email'      => $t->email,
                        'message'    => $t->message,
                        'type'       => $t->type,
                        'parent_id'  => $t->parent_id,
                        'created_at' => $t->created_at,
                        'updated_at' => $t->updated_at,
                    ];
                }),
            ];
        });

        return response()->json(['success' => true, 'messages' => $messages]);
    }

    function reply(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|exists:contacts,id',
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $parent = Contact::findOrFail($request->parent_id);

        if (Auth::check()) {
            // Logged-in user: must own the parent message by user_id
            if ($parent->user_id !== Auth::id()) {
                return response()->json(['success' => false, 'message' => 'Not authorized.'], 403);
            }
        } else {
            // Guest: must own the parent message by session token
            $token = session('contact_token');
            if (!$token || $parent->session_token !== $token) {
                return response()->json(['success' => false, 'message' => 'Not authorized.'], 403);
            }
        }

        $token = session('contact_token', bin2hex(random_bytes(16)));
        session(['contact_token' => $token]);

        $reply = Contact::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'email' => $parent->email,
            'message' => $request->message,
            'type' => 'follow_up',
            'session_token' => $token,
        ]);

        return response()->json(['success' => true, 'reply' => $reply]);
    }
}
