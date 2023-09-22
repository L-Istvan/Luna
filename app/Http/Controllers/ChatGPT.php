<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatGPT
{
    private function checkRequest_count($user_id,$email){
        $user = User::where('id',$user_id)
        ->where('email',$email)
        ->first();
        if ($user->request_count !== 0){
            $user->request_count--;
            if ($user->save()) return true;
        }
        return false;
    }

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
        if ($this->checkRequest_count(Auth::user()->id,Auth::user()->email) === false) return "Elérted a megengedett kéréseid számát.";
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . env('OPENAI_API_KEY')
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => $this->message,
            "max_tokens" => 400,
        ]);
        if ($response->status() === 429) {
            return "Túl sokszor küldtél adatot, várj egy kicsit és próbáld újra.";
        }
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
        $AI = chatGPT(session('history'));
        $arr[] = [
            "role" => "system",
            "content" => $AI,
        ];
        session(['history' => $arr]);
        return response($AI);
    }*/
}
