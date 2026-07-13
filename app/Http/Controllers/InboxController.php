<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Gig;
use Illuminate\Support\Facades\Storage;

class InboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): \Illuminate\View\View: \Illuminate\View\View
    {
        $conversations = Conversation::where('user_id', auth()->id())
            ->with('lastMessage.sender')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('frontend.inbox.index', compact('conversations'));
    }

    public function show($id): \Illuminate\View\View: \Illuminate\View\View
    {
        $conversation = Conversation::where('user_id', auth()->id())
            ->with('messages.sender')
            ->findOrFail($id);

        return view('frontend.inbox.show', compact('conversation'));
    }

    public function sendMessage(Request $request, $id): \Illuminate\Http\RedirectResponse: \Illuminate\Http\RedirectResponse
    {
        $conversation = Conversation::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'message' => 'nullable|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        if (!$request->message && !$request->hasFile('image')) {
            return back()->withErrors(['message' => 'Please enter a message or select an image.']);
        }

        $data = [
            'conversation_id' => $conversation->id,
            'sender_id'       => auth()->id(),
            'message'         => $request->message,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chat-images', 'public');
        }

        Message::create($data);
        $conversation->touch();

        return back();
    }

    public function orderFromGig(Request $request, $gigId, $package): \Illuminate\Http\RedirectResponse: \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('inbox.index')->with('error', 'Gig ordering is no longer available.');
    }
}
