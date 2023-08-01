<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\DictionaryTableNames;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Barryvdh\Debugbar\Facades\Debugbar;

class ChatController extends Controller
{

    public function chatGPT(array $message)
    {

        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . env('OPENAI_API_KEY')
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => $message,
            "max_tokens" => 200,
        ]);
        $data = json_decode($response, true);
        $content = $data['choices'][0]['message']['content'];
        return $content;
    }

    public function chat(Request $request){
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

    }

    public function practicingLearnedWords(){
        $AI = "test";
        return view('chat',['alma' => $AI]);
    }

    public function generateTextFromSavedWords(Request $request){
        Debugbar::info($request['dropdown']);
        $request->validate([
            'dropdown' => ['required','string','min:2','max:20']
        ]);

        $dictionaryTableNames =  DictionaryTableNames::existsTableNameByUserId($request['dropdown'],Auth::user()->id);

        if(!$dictionaryTableNames) return response("Nem létezik ilyen szótár név",404);

        $dictionaryTableValues = $dictionaryTableNames->dictionaryTableValues->pluck('english');

        if (!$dictionaryTableValues) return response()->json('Nem sikerült a szavak lekérdezése.',404);

        $englishWords = $dictionaryTableValues->toArray();

        $message[] = [
            "role" => "user",
            "content" => "Could you write me a short story using these words : ". implode(", ", $englishWords)."?",
        ];

        Debugbar::info($message);
        $AI = self::chatGPT($message);
        return view('chat',['chatGPT_text' => $AI]);

    }

    public function practicingUnknownWords(){
        $arr[] = [
            "role" => "user",
            "content" => "You are an English teacher who asks me a word, and I have to answer you in Hungarian. If I answer incorrectly, you don't tell me the meaning, but explain the question in a circle and ask it again. If I managed to hit you, ask for another word.",
        ];
        $AI = self::chatGPT($arr);
        $arr[] = [
            "role" => "system",
            "content" => $AI,
        ];
        session(['history' => $arr]);
        return view('chat',['chatGPT_text' => $AI]);
    }




    public function createNewDictionary(){
        return view('chat',['chatGPT_text'=>'4']);
    }

    public function answersToQuestions(){
        return view('chat',['chatGPT_text'=>'5']);
    }

    public function askingQuestion(){
        return view('chat',['chatGPT_text'=>'6']);
    }

    public function sentenceCheck(){
        return view('chat',['chatGPT_text'=>'7']);
    }

    public function phraseLearning(){
        return view('chat',['chatGPT_text'=>'8']);
    }

}
