<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ChatGPT;

class SentenceCheckController extends Controller
{

    private function generate(string $sentence){
        $text = '"'.$sentence.'"';
        $chatGPT = new ChatGPT('user',$text." Can you correct this sentence and explain if it is wrong?");
        $englishMessage = $chatGPT->sendToChatGPT();
        $chatGPT = new ChatGPT('user',"Fordítsd le ezt a mondatot magyar nyelvre: ".$englishMessage);
        $hungarianMessage = $chatGPT->sendToChatGPT();
        return $englishMessage."\n\n\n".$hungarianMessage;
    }

    public function index(){
        return view('sentenceCheck',['message' => "Ide tudod írni a mondatot, a mondat ellenőrzéshez."]);
    }

    public function show(Request $request){
        $request->validate([
            'input' => ['required','string','max:300'],
        ],
        [
            'input.required' => 'A mondat mező kitöltése kötelező!',
            'input.string' => 'A mondat mező csak szöveget tartalmazhat!',
            'input.max' => 'A mondat mező maximum 300 karakter hosszú lehet!',
        ]);
        $request = $request->all();
        $message = $this->generate($request['input']);

        if($message === null) return response()->json("Hiba történt a kérés feldolgozása során.",200);
        return response()->json($message,200);
    }
}
