<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class MyMessageController extends Controller
{
    private function tokenForEmail($email)
    {
        return hash('sha256', $email . config('app.key'));
    }

    function checkSession()
    {
        $hasToken = session()->has('contact_token');
        return response()->json(['hasSession' => $hasToken || Auth::check()]);
    }

    function fetch(Request $request)
    {
        $token = session('contact_token');

        $rows = Contact::root()
            ->where('type', 'message')
            ->where(function ($q) use ($token) {
                if (Auth::check()) {
                    $q->where('user_id', Auth::id());
                    if ($token) {
                        $q->orWhere('session_token', $token);
                    }
                } elseif ($token) {
                    $q->where('session_token', $token);
                } else {
                    $q->whereRaw('1 = 0');
                }
            })
            ->latest()
            ->with(['replies' => function ($q) {
                $q->orderBy('created_at');
            }])
            ->get();

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

    function lookup(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $token = $this->tokenForEmail($request->email);
        session(['contact_token' => $token]);

        $rows = Contact::root()
            ->where('type', 'message')
            ->where('session_token', $token)
            ->latest()
            ->with(['replies' => fn ($q) => $q->orderBy('created_at')])
            ->get();

        return response()->json(['success' => true, 'messages' => $rows->map(function ($msg) {
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
                'thread'     => $thread->map(fn ($t) => [
                    'id'         => $t->id,
                    'name'       => $t->name,
                    'email'      => $t->email,
                    'message'    => $t->message,
                    'type'       => $t->type,
                    'parent_id'  => $t->parent_id,
                    'created_at' => $t->created_at,
                    'updated_at' => $t->updated_at,
                ]),
            ];
        })]);
    }

    function reply(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|exists:contacts,id',
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $parent = Contact::findOrFail($request->parent_id);

        $token = session('contact_token');
        $authorized = false;

        if (Auth::check() && $parent->user_id === Auth::id()) {
            $authorized = true;
        }

        if ($token && $parent->session_token === $token) {
            $authorized = true;
        }

        if (!$authorized) {
            return response()->json(['success' => false, 'message' => 'Not authorized.'], 403);
        }

        // Ensure reply uses the same deterministic token
        if (!$token) {
            $token = $this->tokenForEmail($parent->email);
            session(['contact_token' => $token]);
        }

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
