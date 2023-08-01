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
        return view('reading',['tableNames' => $tableNames]);
    }

    public function generateTextFromSavedWords(Request $request){
        Debugbar::info($request['dropdown']);
        $request->validate([
            'dropdown' => ['required','string','min:2','max:20']
        ]);

        $dictionaryTableNames =  DictionaryTableNames::existsTableNameByUserId($request['tableName'],Auth::user()->id);

        if(!$dictionaryTableNames) return response("Nem létezik ilyen szótár név",404);

        $dictionaryTableValues = $dictionaryTableNames->dictionaryTableValues->pluck('english');

        if ($dictionaryTableValues)return view('chat',['englishWords' => $dictionaryTableValues]);
        return response()->json('Nem sikerült a szavak lekérdezése.',404);
    }

    public function individually()
    {
        return view('chat',["chatGPT_text" => "Add meg a szavakat szoközzel elválasztva vagy vesszővel és már generálom is."]);
    }



}
