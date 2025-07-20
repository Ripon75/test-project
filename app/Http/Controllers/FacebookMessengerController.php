<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FacebookMessengerController extends Controller
{
    public function handle(Request $request)
    {
        // Handle verification
        if ($request->isMethod('get')) {
            $verify_token = 'myverifytoken';
            if ($request->get('hub_verify_token') === $verify_token) {
                return response($request->get('hub_challenge'), 200);
            }

            return response('Invalid verify token', 403);
        }

        // Handle incoming messages (POST)
        $data = $request->all();

        foreach ($data['entry'] as $entry) {
            foreach ($entry['messaging'] as $messageEvent) {
                if (isset($messageEvent['message']['text'])) {
                    $senderId = $messageEvent['sender']['id'];
                    $userMessage = $messageEvent['message']['text'];

                    $reply = $this->askChatGPT($userMessage);
                    $this->sendFacebookMessage($senderId, $reply);
                }
            }
        }

        return response('EVENT_RECEIVED', 200);
    }

    private function askChatGPT($message)
    {
        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $message],
                ],
            ]);

        return $response->json('choices.0.message.content') ?? "I'm sorry, I didn't understand.";
    }

    private function sendFacebookMessage($recipientId, $message)
    {
        $pageAccessToken = env('FB_PAGE_ACCESS_TOKEN');

        Http::post("https://graph.facebook.com/v18.0/me/messages?access_token=$pageAccessToken", [
            'recipient' => [
                'id' => $recipientId,
            ],
            'message' => [
                'text' => $message,
            ],
        ]);
    }
}
