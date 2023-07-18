<?php

namespace App\Http\Controllers;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function practicingLearnedWords(){

        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => '1. Labrador Retriever 2. Vizsla 3. Yorki 4. Német Juhászkutya 5. Poodle '.'írj még 5 fajtát.',
            'max_tokens' => 100,
        ]);

        $alma = $result['choices'][0]['text'];
        //$alma = $tokenCount = $result['usage']['total_tokens'];
        return view('chat',['alma' => $alma]);
    }

    public function readingFromLearnedWords(){
        return view('chat',['alma' => "2"]);
    }

    public function practicingUnknownWords(){
        return view('chat',['alma'=>'3']);
    }

    public function createNewDictionary(){
        return view('chat',['alma'=>'4']);
    }

    public function answersToQuestions(){
        return view('chat',['alma'=>'5']);
    }

    public function askingQuestion(){
        return view('chat',['alma'=>'6']);
    }

    public function sentenceCheck(){
        return view('chat',['alma'=>'7']);
    }

    public function phraseLearning(){
        return view('chat',['alma'=>'8']);
    }

}
