<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;

class AiChatController extends Controller
{
    protected GeminiService $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

    /**
     * Handle chat messages from the AI agent
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'history' => 'nullable|array',
            'history.*.role' => 'required|string|in:user,assistant',
            'history.*.content' => 'required|string',
        ]);

        $message = $request->input('message');
        $history = $request->input('history', []);

        // Keep only last 20 messages for context window management
        $history = array_slice($history, -20);

        $reply = $this->gemini->chat($message, $history);

        return response()->json([
            'success' => true,
            'reply' => $reply,
        ]);
    }

    /**
     * Health check endpoint
     */
    public function status()
    {
        $apiKey = config('services.gemini.api_key', '');
        $configured = !empty($apiKey);

        return response()->json([
            'configured' => $configured,
            'status' => $configured ? 'AI Agent is ready' : 'API key not configured',
        ]);
    }
}
