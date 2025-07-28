<?php

return [
    'api_key' => env('GROQ_API_KEY'),
    'api_url' => env('GROQ_API_URL', 'https://api.groq.com/openai/v1/chat/completions'),
    'model' => env('GROQ_MODEL', 'llama3-8b-8192'),
    'max_tokens' => env('GROQ_MAX_TOKENS', 1000),
    'temperature' => env('GROQ_TEMPERATURE', 0.7),
];