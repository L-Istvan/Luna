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
            'text' => ['required','string','min:2','max:1000']
        ]);
        $request = $request->all();

        $chatGPT = new ChatGPT('user','translate this into Hungarian: "'.$request['text'].'"');
        $chatGPT = $chatGPT->sendToChatGPT();

        return response()->json($chatGPT,200);
    }

}
