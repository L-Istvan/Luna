<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DictionaryTableNames;
use Illuminate\Support\Facades\Auth;
use App\Models\DictionaryTableValues;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\ChatGPT;

class PracticingWrodsController extends Controller
{
    public function index($dictionaryName){
        return view('practicingWords/wordsFromDictionary',
        ['dictionaryName' => $dictionaryName]);
    }

    private function rouletWheel($arr){
        $probabilities = [];
        $sum_proportionally = array_sum($arr);
        foreach ($arr as $proportionally){
            $probabilities[] = $proportionally/$sum_proportionally;
        }
        $random = mt_rand() / mt_getrandmax();
        $value = 0;
        for($index =0; $index < count($arr); $index++){
            $value += $probabilities[$index];
            if ($random <= $value){
                return $index;
            }
        }
    }

    private function containsValue($array, $search) {
        foreach ($array as $item) {
            if (in_array($search, $item)) {
                return true;
            }
        }
        return false;
    }

    private function isCorrect($selectedEnglish,$dictionaryName,$question,$answer){
        if($selectedEnglish == 1){ //
            $correctAnswerArray = DictionaryTableValues::selectHungarianWords(Auth::user()->id,$dictionaryName,$question);
            return $this->containsValue($correctAnswerArray,strtolower($answer));
        }
        if ($selectedEnglish == 0){
            $correctAnswer = DictionaryTableValues::selectEnglishWord(Auth::user()->id,$dictionaryName,$question);
            Debugbar::info($correctAnswer);
            if ($correctAnswer[0] === $answer) return true;
            return false;
        }
    }

    private function update(string $dictionaryName, int $user_id, bool $isCorrect ,string $word){
        $dictionaryTableValues = DictionaryTableValues::where('user_id',$user_id)
        ->where('tableName',$dictionaryName)
        ->where('english',$word)
        ->first();
        if ($isCorrect){
            $correct_point = $dictionaryTableValues->correct_point +1;
            $dictionaryTableValues->correct_point = $correct_point;
            $dictionaryTableValues->proportionality = $dictionaryTableValues->incorrect_point / ($correct_point + $dictionaryTableValues->incorrect_point);
        }
        else{
            $incorrect_point = $dictionaryTableValues->incorrect_point +1;
            $dictionaryTableValues->incorrect_point = $incorrect_point;
            $dictionaryTableValues->proportionality = $incorrect_point / ($dictionaryTableValues->correct_point + $incorrect_point);
        }
        $dictionaryTableValues->update();
    }

    public function AIHelp(Request $request){
        $request->validate([
            'lastQuestion' => ['required','string','min:2','max:40'],
            'level' => ['required','numeric','in:1,2'],
        ],
        [
            'lastQuestion.required' => 'A szó nem lehet üres',
            'lastQuestion.string' => 'A szó nem lehet üres',
            'lastQuestion.min' => 'A szó minimum 2 karakter hosszú lehet',
            'lastQuestion.max' => 'A szó maximum 40 karakter hosszú lehet',
        ]);
        if($request['level']){
            $chatGPT = new ChatGPT('user','I am learning English, could you explain the meaning of the word '.$request['lastQuestion'].' in a few words?');
        }
        else{
            $chatGPT = new ChatGPT('user','I am learning English, could you explain the meaning of the word '.$request['lastQuestion'].' in a few sentences?');
        }

        $answer = $chatGPT->sendToChatGPT();
        if ($answer === null) return response()->json("Valami hiba történt",500);
        return response()->json($answer,200);
    }

    public function show(Request $request){
        $request->validate([
            'dictionaryName' => ['required','string','min:2','max:20'],
            'selectedEnglish' => ['required','numeric','in:0,1'],
            'question' => ['string','min:2','max:20'],
            'answer' => ['max:20'],
        ]);
        $request = $request->all();

        $dictionaryTableNames = DictionaryTableNames::existsTableNameByUserId($request['dictionaryName'],Auth::user()->id);
        if (!$dictionaryTableNames) return response()->json("Nincs ilyen szótár",404);

        $words = $dictionaryTableNames->dictionaryTableValues($request['dictionaryName'])->toArray();
        if($words == null) return response()->json("Nem találtam szavakat a szótárban.",404);

        $proportionalityValues = collect($words)->pluck('proportionality')->toArray();
        $selectedIndex = $this->rouletWheel($proportionalityValues);

        $message = "";
        if($request['answer'] != null or $request['answer'] != ""){
            if($this->isCorrect($request['selectedEnglish'],$request['dictionaryName'],$request['question'],$request['answer'])){
                $message = "Helyes! Most fordítsd le a(z) ";
                $this->update($request['dictionaryName'],Auth::user()->id,true,$request['question']);
            }
            else {
                $message = "Sajnos rossz válasz. Itt az újabb szó: ";
                $this->update($request['dictionaryName'],Auth::user()->id,false,$request['question']);
            }
        }

        if ($request['selectedEnglish']){
            return response()->json(['message' => $message,'word' => $words[$selectedIndex]['english']]);
        }
        else{
            return response()->json(['message' => $message,
            'word' => $words[$selectedIndex]['hungarian1']]);
        }
    }

}
