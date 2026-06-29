<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Account;

class GeminiService
{
    protected string $apiKey;
    protected string $endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';
    protected int $maxRetries = 3;
    protected int $retryDelay = 1000000; // 1 second in microseconds

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key', '');
    }

    /**
     * Build system context with dynamic blood bank info
     */
    protected function buildSystemContext(): array
    {
        $bank = Account::first();
        $bankName = $bank->name ?? 'ব্লাড ব্যাংক';
        $phone = $bank->phone ?? 'সেট করা হয়নি';
        $email = $bank->email ?? 'সেট করা হয়নি';
        $website = $bank->website ?? 'সেট করা হয়নি';

        $systemPrompt = "You are an AI assistant for '{$bankName}', a blood donation management system in Bangladesh. Follow these rules:

1. LANGUAGE: Respond in the same language the user uses. If they write in Bengali, reply in Bengali. If English, reply in English. Support mixing both.

2. PERSONA: You are a friendly, professional blood bank assistant. You help users find blood donors, understand blood groups, guide through emergency requests, and answer questions about blood donation.

3. OUR BLOOD BANK INFO (use this when users ask for contact details):
   - Name: {$bankName}
   - Phone / Hotline: {$phone}
   - Email: {$email}
   - Website: {$website}

4. BEHAVIOR:
   - Be concise but helpful. Ask clarifying questions when needed.
   - If someone says 'I need blood', ask: what blood group, where, how urgent, etc.
   - If someone wants to donate, guide them to register or find donation centers.
   - Provide accurate blood group compatibility info.
   - For emergencies, direct users to call the hotline ({$phone}) or visit the emergency request page.

5. CAPABILITIES:
   - Explain blood group compatibility (who can donate to whom)
   - Guide users on how to use the blood bank system
   - Provide general blood donation information
   - Help with emergency blood request guidance
   - NOT a medical professional - always advise consulting doctors for medical advice

6. BLOOD GROUP COMPATIBILITY (quick reference):
   - O- : Universal donor (can donate to all)
   - O+ : Can donate to O+, A+, B+, AB+
   - A- : Can donate to A-, A+, AB-, AB+
   - A+ : Can donate to A+, AB+
   - B- : Can donate to B-, B+, AB-, AB+
   - B+ : Can donate to B+, AB+
   - AB- : Can donate to AB-, AB+
   - AB+ : Universal recipient (can receive from all)

7. EMERGENCY: If someone has a life-threatening emergency, tell them to call the emergency hotline ({$phone}) immediately or visit the nearest hospital.

Keep responses helpful, warm, and informative.";

        return [
            [
                'role' => 'user',
                'parts' => [['text' => $systemPrompt]]
            ],
            [
                'role' => 'model',
                'parts' => [['text' => 'Understood! I am ready to help users with their blood bank needs in Bengali or English.']]
            ]
        ];
    }

    /**
     * Send a chat message to Gemini and get a response
     */
    public function chat(string $message, array $history = []): string
    {
        if (empty($this->apiKey)) {
            return '⚠️ AI সেবা চালু করার জন্য API Key কনফিগার করা হয়নি। অনুগ্রহ করে .env ফাইলে GEMINI_API_KEY সেট করুন।';
        }

        try {
            // Build context with latest blood bank info
            $contents = $this->buildSystemContext();

            // Add history (skip system messages)
            foreach ($history as $entry) {
                if (isset($entry['role']) && isset($entry['content'])) {
                    $geminiRole = $entry['role'] === 'assistant' ? 'model' : 'user';
                    $contents[] = [
                        'role' => $geminiRole,
                        'parts' => [['text' => $entry['content']]]
                    ];
                }
            }

            // Add current user message
            $contents[] = [
                'role' => 'user',
                'parts' => [['text' => $message]]
            ];

            // Retry logic with exponential backoff for rate limits
            $response = null;

            for ($attempt = 1; $attempt <= $this->maxRetries; $attempt++) {
                $response = Http::timeout(30)
                    ->post($this->endpoint . '?key=' . $this->apiKey, [
                        'contents' => $contents,
                        'generationConfig' => [
                            'temperature' => 0.7,
                            'maxOutputTokens' => 800,
                            'topP' => 0.9,
                            'topK' => 32,
                        ],
                        'safetySettings' => [
                            ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                            ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                            ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                            ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                        ],
                    ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

                    if (empty($reply)) {
                        return 'দুঃখিত, আমি উত্তর দিতে পারিনি। অনুগ্রহ করে আবার চেষ্টা করুন।';
                    }

                    return trim($reply);
                }

                $status = $response->status();

                Log::warning('Gemini API attempt failed', [
                    'attempt' => $attempt,
                    'status' => $status,
                ]);

                // If not a 429 rate limit error, don't retry
                if ($status !== 429) {
                    break;
                }

                // Wait before retry: 1s, 2s, 3s
                if ($attempt < $this->maxRetries) {
                    usleep($this->retryDelay * $attempt);
                }
            }

            // All retries failed - give user-friendly message
            $status = $response->status() ?? 0;

            if ($status === 429) {
                return '⚠️ এই মুহূর্তে অনেক রিকোয়েস্ট আছে। দয়া করে একটু পরে আবার চেষ্টা করুন।';
            }
            if ($status === 403) {
                return '⚠️ API Key সঠিক নয় বা মেয়াদ শেষ হয়ে গেছে। অনুগ্রহ করে অ্যাডমিনকে জানান।';
            }
            if ($status === 400) {
                return 'দুঃখিত, আপনার প্রশ্নটি প্রক্রিয়া করতে সমস্যা হয়েছে। অন্যভাবে প্রশ্নটি করুন।';
            }
            if ($status === 500 || $status === 503) {
                return 'দুঃখিত, AI সার্ভারে সাময়িক সমস্যা হচ্ছে। একটু পর আবার চেষ্টা করুন।';
            }

            return 'দুঃখিত, একটি ত্রুটি হয়েছে। অনুগ্রহ করে কিছুক্ষণ পর আবার চেষ্টা করুন।';

        } catch (\Exception $e) {
            Log::error('Gemini chat exception: ' . $e->getMessage());
            return 'দুঃখিত, সার্ভারের সাথে সংযোগ স্থাপনে সমস্যা হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।';
        }
    }
}
