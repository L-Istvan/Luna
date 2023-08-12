<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DictionaryTableNames;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;

class ReadingController extends Controller
{
    public function index()
    {
        $tableNames = DictionaryTableNames::tableNamesByUser(Auth::user()->id);
        if ($tableNames === 0) $tableNames = ["Jelenleg nincs táblája."];
        return view('reading/selectionPage',['tableNames' => $tableNames]);
    }

    public function show(){
        return view('reading/reading',["chatGPT_text" => "Add meg a szavakat szoközzel elválasztva és már generálom is."]);
    }



    public function generateTextFromSavedWords(Request $request){
        Debugbar::info($request['dropdown']);
        $request->validate([
            'dropdown' => ['required','string','min:2','max:20']
        ]);

        $dictionaryTableNames =  DictionaryTableNames::existsTableNameByUserId($request['tableName'],Auth::user()->id);

        if(!$dictionaryTableNames) return response("Nem létezik ilyen szótár név",404);

        $dictionaryTableValues = $dictionaryTableNames->dictionaryTableValues->pluck('english');

        if ($dictionaryTableValues)return view('reading/reading',['englishWords' => $dictionaryTableValues]);
        return response()->json('Nem sikerült a szavak lekérdezése.',404);
    }





}
