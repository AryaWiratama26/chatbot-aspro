<?php

namespace App\Http\Controllers;

use App\Services\ChatbotService;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    protected $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $message = $request->input('message');
        $response = $this->chatbotService->generateResponse($message);

        return response()->json([
            'response' => $response,
            'timestamp' => now()->format('H:i')
        ]);
    }
}