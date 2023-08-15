<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ChatGPT;

class QuestionController extends Controller
{

    private function generate($text){
        $text = '"'.$text.'"';
        $chatGPT = new ChatGPT('user',$text."is the grammatically correct question? If not, can you explain why not?");
        $englisMessage = $chatGPT->sendToChatGPT();
        $chatGPT = new ChatGPT('user',"Letudod fordítani ezt a mondatot magyarra? : ".$englisMessage);
        $hungaryMessage = $chatGPT->sendToChatGPT();
        return $englisMessage."\n\n\n".$hungaryMessage;
    }

    public function index(){
        return view('question',['message'=>"Ide tudod írni a kérdést, és ha rossz akkor kijavítom."]);
    }

    public function show(Request $request){
        $request->validate([
            'input' => ['required','string','min:10','max:50']
        ],
        [
            'input.require' => 'A mező kitöltése kötelező!',
            'input.string' => 'A mező csak szöveget tartalmazhat!',
            'input.min' => 'A mező tartalma túl rövid!',
            'input.max' => 'A mező tartalma túl hosszú!'
        ]);
        $request->all();
        $message = $this->generate($request['input']);

        if ($message === null) response()->json("Hiba történt a kérés feldolgozása során.");
        return response()->json($message,200);
    }
}
