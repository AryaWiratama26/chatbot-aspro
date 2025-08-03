<?php

namespace App\Services;

use App\Models\KnowledgeBase;
use App\Models\Announcement;
use GuzzleHttp\Client;
use Exception;

class ChatbotService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function generateResponse($userMessage)
    {
        try {
            $knowledgeData = $this->searchKnowledgeBase($userMessage);
            $announcementData = $this->searchAnnouncements($userMessage);

            
            $context = $this->buildContext($knowledgeData, $announcementData);

            
            return $this->callGroqAPI($userMessage, $context);

        } catch (Exception $e) {
            return "Maaf, saat ini sistem chatbot sedang mengalami gangguan. Silakan coba lagi nanti atau hubungi admin.";
        }
    }

    private function searchKnowledgeBase($query)
    {
        return KnowledgeBase::active()
            ->search($query)
            ->limit(5)
            ->get();
    }

    private function searchAnnouncements($query)
    {
        return Announcement::active()
            ->published()
            ->search($query)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
    }

    private function buildContext($knowledge, $announcements)
    {
        $context = "INFORMASI PRAKTIKUM:\n\n";

        // Tambahkan knowledge base
        if ($knowledge->count() > 0) {
            $context .= "MATERI & INFORMASI UMUM:\n";
            foreach ($knowledge as $item) {
                $context .= "- {$item->title}: {$item->content}\n\n";
            }
        }

        // Tambahkan pengumuman
        if ($announcements->count() > 0) {
            $context .= "PENGUMUMAN TERBARU:\n";
            foreach ($announcements as $announcement) {
                $date = $announcement->published_at->format('d/m/Y H:i');
                $context .= "- [{$date}] {$announcement->title}: {$announcement->content}\n\n";
            }
        }

        if ($knowledge->count() === 0 && $announcements->count() === 0) {
            $context .= "Tidak ada informasi spesifik yang ditemukan untuk pertanyaan ini.\n\n";
        }

        return $context;
    }

    private function callGroqAPI($message, $context)
    {
        $systemPrompt = "Anda adalah asisten virtual untuk praktikum. Jawab pertanyaan mahasiswa dengan ramah dan informatif berdasarkan informasi yang tersedia. Jika informasi tidak tersedia, berikan saran untuk menghubungi admin atau asisten praktikum.";

        $userPrompt = "{$context}\n\nPertanyaan mahasiswa: {$message}\n\nJawab dengan bahasa Indonesia yang ramah dan mudah dipahami:";

        $response = $this->client->post(config('groq.api_url'), [
            'headers' => [
                'Authorization' => 'Bearer ' . config('groq.api_key'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => config('groq.model'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt
                    ],
                    [
                        'role' => 'user',
                        'content' => $userPrompt
                    ]
                ],
                'max_tokens' => config('groq.max_tokens'),
                'temperature' => config('groq.temperature')
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['message']['content'] ?? 'Maaf, tidak dapat memproses pertanyaan Anda saat ini.';
    }
}