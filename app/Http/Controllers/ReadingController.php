<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DictionaryTableNames;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\ChatGPT;

class ReadingController extends Controller
{
    public function selectionPageIndex()
    {
        $tableName = DictionaryTableNames::tableNamesByUser(Auth::user()->id);
        if ($tableName === 0) $tableName = ["Jelenleg nincs táblája."];
        return view('reading/selectionPage',['tableNames' => $tableName]);
    }

    public function fromDictionaryIndex(Request $request){
        $request = $request->all();
        return view('reading/reading',['dictionaryName' => $request['tableName'],'chatGPT_text' => "Kis türelmet kérek."]);
    }

    public function fromSelectedWordsIndex(){
        return view('reading/reading',['dictionaryName' => "","chatGPT_text" => "Sorold fel a szavakat vesszővel elválasztva."]);
    }

    public function generateTextFromSavedWords(Request $request){
        $request->validate([
            'dictionaryName' => ['required','string','min:2','max:20']
        ]);
        $request = $request->all();

        $dictionaryTableNames =  DictionaryTableNames::existsTableNameByUserId($request['dictionaryName'],Auth::user()->id);

        if(!$dictionaryTableNames) return response("Nem létezik ilyen szótár név",404);

        $englishWords = $dictionaryTableNames->dictionaryTableValues($request['dictionaryName'])->pluck('english')->toArray();
        if ($englishWords == null) return response()->json('Nem találtam a szótárba szavakat',404);

        $chatGPT = new ChatGPT('user','Could you write me a short story using these words : '. implode(", ", $englishWords)."?");
        $chatGPT = $chatGPT->sendToChatGPT();

        return response()->json($chatGPT,200);
    }

    public function translateText(Request $request){
        $request->validate([
            'text' => ['required','string','min:2','max:1500']
        ],
        [
            'text.required' => 'A szöveg mező kitöltése kötelező.',
            'text.string' => 'A szöveg mező csak szöveget tartalmazhat.',
            'text.min' => 'A szöveg mezőben legalább 2 karakternek kell lennie.',
            'text.max' => 'A szöveg mezőben legfeljebb 1500 karakternek kell lennie.'
        ]);
        $request = $request->all();

        $chatGPT = new ChatGPT('user','translate this into Hungarian: "'.$request['text'].'"');
        $chatGPT = $chatGPT->sendToChatGPT();

        return response()->json($chatGPT,200);
    }

    public function generateTextFromSelectedWords(Request $request){
        $request->validate([
            'text' => ['required','string','min:2','max:1000','not_regex:/[?!,.\-]/']
        ],
        [
            'text.required' => 'A szöveg mező kitöltése kötelező.',
            'text.string' => 'A szöveg mező csak szöveget tartalmazhat.',
            'text.min' => 'A szöveg mezőben legalább 2 karakternek kell lennie.',
            'text.max' => 'A szöveg mezőben legfeljebb 1000 karakternek kell lennie.',
            'text.not_regex' => 'A szöveg mezőben nem lehetnek írásjelek.'
        ]);
        $request = $request->all();

        $chatGPT = new ChatGPT('user',"Could you write me a short story using these words : ".$request['text']."?");
        $chatGPT = $chatGPT->sendToChatGPT();
        return response()->json($chatGPT,200);
    }

}
