<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Models\MostCommonWords;

class practicingUnknownWordsController extends Controller
{
    public function index(){
        return view('practicingWords/unknownWords');
    }

    private function containsValue($array, $search) {
        foreach ($array as $item) {
            if ($item === $search or $item === $search." ") return true;
        }
        return false;
    }

    private function isCorrect(int $selectedEnglish, string $search, $answer, $question){
        if($selectedEnglish == 1){
            $correctAnswerArray = MostCommonWords::where('english',$search)->pluck('hungarian')[0];
            $correctAnswerArray = explode(',',$correctAnswerArray);
            if ($this->containsValue($correctAnswerArray,strtolower($answer))) return "Helyes most fordítsd le a(z) : ";
            $getCorrectWords = MostCommonWords::where('english',$question)->pluck('hungarian')[0];
            return "Sajnos rossz válasz, jelentése : ".$getCorrectWords ."\nItt az újabb szó: ";
        }
        if ($selectedEnglish == 0){
            $correctAnswer = MostCommonWords::where('hungarian',$search)->pluck('english')[0];
            if ($correctAnswer === $answer) return "Helyes most fordítsd le a(z) : ";
            $getCorrectWord = MostCommonWords::where('hungarian',$question)->pluck('english')[0];
            return "Sajnos rossz válasz, jelentése : ".$getCorrectWord ."\nItt az újabb szó: ";
        }
    }

    public function show(Request $request){

        $request->validate([
            'selectedEnglish' => ['required','numeric','in:0,1'],
            'question' => ['max:500'],
            'answer' => ['max:20'],
        ]);
        $request = $request->all();
        $tableRow = MostCommonWords::count();
        $random = rand(1,$tableRow);

        $message = "";
        if ($request['question'] !== null and $request['answer'] !== null ){
            $message = $this->isCorrect($request['selectedEnglish'],$request['question'],$request['answer'],$request['question']);
        }

        if ($request['selectedEnglish'] == 1){
            $question = MostCommonWords::where('id',$random)->pluck('english');
            return response()->json(['message' => $message,'word' => $question[0]],200);
        }
        else{
            $question = MostCommonWords::where('id',$random)->pluck('hungarian');
            return response()->json(['message' => $message,'word' => $question[0]],200);
        }
    }
}
