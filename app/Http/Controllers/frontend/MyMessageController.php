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

        $rows = Contact::root()
            ->where('email', $request->email)
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
                'reply'      => $msg->reply,
                'replied_at' => $msg->replied_at,
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
