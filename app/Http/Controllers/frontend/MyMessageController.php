<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class MyMessageController extends Controller
{
    function fetch(Request $request)
    {
        $email = session('contact_email') ?: $request->input('email');

        $rows = Contact::root()
            ->where('email', $email)
            ->where('type', 'message')
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

    function reply(Request $request)
    {
        $email = session('contact_email');
        if (!$email) {
            return response()->json(['success' => false, 'message' => 'Not authenticated.'], 403);
        }

        $request->validate([
            'parent_id' => 'required|exists:contacts,id',
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $parent = Contact::findOrFail($request->parent_id);

        if ($parent->email !== $email) {
            return response()->json(['success' => false, 'message' => 'Email does not match.'], 403);
        }

        $reply = Contact::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'email' => $email,
            'message' => $request->message,
            'type' => 'follow_up',
        ]);

        return response()->json(['success' => true, 'reply' => $reply]);
    }
}
