<?php

namespace App\Http\Controllers\Admin;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use App\Services\ZoomService;
use App\Http\Controllers\Controller;

class ZoomController extends Controller
{
    protected $zoomService;
    private $apiKey;
    private $apiSecret;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
        $this->apiKey = env('ZOOM_API_KEY');
        $this->apiSecret = env('ZOOM_API_SECRET');
    }

    public function index()
    {
        $signature = $this->zoomService->generateSignature(1);

        return view('adminend.pages.zoom.index', ["signature" => $signature]);
    }

    // public function create(Request $request)
    // {
    //     $meetingData = [
    //         'topic'      => 'Laravel Zoom Meeting',
    //         'type'       => 2, // Scheduled meeting
    //         'start_time' => now()->addHour()->format('Y-m-d\TH:i:s\Z'), // Adjust start time
    //         'duration'   => 30, // Duration in minutes
    //         'timezone'   => 'UTC',
    //         'agenda'     => 'Project discussion',
    //         'settings'   => [
    //             'host_video' => true,
    //             'participant_video' => true,
    //             'mute_upon_entry' => true,
    //         ],
    //     ];

    //     $response = $this->zoomService->createMeeting($meetingData);

    //     return view('zoom.meeting', [
    //         'meetingNumber' => $response['id'],
    //         'password'      => $response['password'],
    //         'startUrl'      => $response['start_url'],
    //         'joinUrl'       => $response['join_url']
    //     ]);
    // }

    public function create()
    {
        // Replace with your Zoom API credentials
        $apiKey = env('ZOOM_API_KEY');
        $apiSecret = env('ZOOM_API_SECRET');

        // Generate JWT token
        $jwt = $this->generateJWT($this->apiKey, $this->apiSecret);

        $client = new Client();

        $response = $client->request('POST', 'https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => 'Bearer ' . $jwt,
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'topic' => 'My Zoom Meeting',
                'start_time' => '2023-11-22T10:00:00Z', // Replace with desired start time
                'duration' => 30,
                'agenda' => 'Meeting Agenda',
                'timezone' => 'Asia/Dhaka', // Replace with your timezone
                'settings' => [
                    'host_video' => true,
                    'participant_video' => true,
                    'join_before_host' => false,
                    'mute_upon_entry' => false,
                    'watermark' => false,
                    'use_meeting_password' => false,
                    'auto_recording' => 'none'
                ]
            ]
        ]);

        $meetingData = json_decode($response->getBody(), true);

        dd($meetingData);
    }

    private function generateJWT()
    {
        $payload = [
            'iss' => $this->apiKey,
            'exp' => time() + 3600, // Token valid for 1 hour
        ];

        return JWT::encode($payload, $this->apiSecret, 'HS256');
    }


}
