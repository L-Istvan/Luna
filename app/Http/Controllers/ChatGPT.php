<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class ChatGPT
{
    private $message = [];

    public function __construct($role, $content)
    {
        $this->message[] = [
            "role" => $role,
            "content" => $content
        ];
    }

    public function getMessage(){
        return $this->message;
    }

    public function sendToChatGPT()
    {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . env('OPENAI_API_KEY')
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => $this->message,
            "max_tokens" => 200,
        ]);
        if ($response->successful()) {
            $data = json_decode($response, true);
            $content = $data['choices'][0]['message']['content'];
            return $content;
        }
        return null;
    }

    /*public function history(Request $request){
        $userInput = $request->json()->all();
        $arr = session('history');
        $arr[] = [
            "role" => "user",
            "content" => $userInput[0],
        ];
        session(['history' => $arr]);
        $AI = self::chatGPT(session('history'));
        $arr[] = [
            "role" => "system",
            "content" => $AI,
        ];
        session(['history' => $arr]);
        return response($AI);
    }*/
}
