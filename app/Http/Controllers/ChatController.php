<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        $chatData = [
            'online_users' => 10,
            'chat_rooms' => [
                ['id' => 1, 'name' => 'General Chat', 'active' => true],
            ]
        ];

        return view('chat', compact('chatData'));
    }

    public function send(Request $request)
    {
        $userMessage = $request->input('message');

        try {
            $response = Http::withToken(env('OPENAI_API_KEY'))
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'user', 'content' => $userMessage],
                    ],
                ]);

            info($response->body());

            if (!$response->successful()) {
                return $this->errorResponse('Sorry, there was an error contacting the AI service.');
            }

            $aiMessage = $response->json('choices.0.message.content');

            if (!$aiMessage) {
                return $this->errorResponse('Sorry, the AI did not return a valid response.');
            }

            return $this->successResponse($aiMessage);
        } catch (\Throwable $e) {
            report($e);
            return $this->errorResponse('Sorry, there was an error processing your request.');
        }
    }

    private function successResponse(string $message)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'AI response generated successfully.',
            'data' => [
                'id' => uniqid('msg_', true), // optional
                'user_name' => 'AI Assistant',
                'user_avatar' => 'AI',
                'message' => $message,
                'timestamp' => now()->toISOString(),
                'is_sent_by_me' => false,
                'is_ai' => true,
            ],
        ], 200);
    }

    private function errorResponse(string $errorMessage)
    {
        return response()->json([
            'status' => 'error',
            'message' => $errorMessage,
            'data' => [
                'id' => uniqid('msg_', true),
                'user_name' => 'AI Assistant',
                'user_avatar' => 'AI',
                'message' => $errorMessage,
                'timestamp' => now()->toISOString(),
                'is_sent_by_me' => false,
                'is_ai' => true,
            ],
        ], 500);
    }
}
