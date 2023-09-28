<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DictionaryTableNames;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Models\DictionaryTableValues;

class DictionaryController extends Controller
{
    public function customValidate($request){
        $request->validate([
            'tableName' => ['required','string','min:2','max:40'],
            'english' => ['required','string','min:2','max:40'],
            'hun1' => ['nullable','string','max:40'],
            'hun2' => ['nullable','string','min:2','max:40'],
            'hun3' => ['nullable','string','max:40'],
        ],
        [
            'required' => "Az angol mező kitöltése kötelező",
            'string' => "Csak karakterlánct lehet megadni.",
            'min' => "Legalább 2 karakternél nagyobb kell lenni vagy üresen hagyni a mezőt.",
            'max' => "Legfeljebb 40 karaktert lehet megadni."
        ]);
    }


    public function create(){
        return view('dictionary');
    }

    public function edit($tableName){
        $dictionaryTableNames =  DictionaryTableNames::existsTableNameByUserId($tableName,Auth::user()->id);
        if ($dictionaryTableNames){
            $dictionaryTableValues = $dictionaryTableNames->dictionaryTableValues($tableName);
            return  view('dictionary',["tableValues" => $dictionaryTableValues,"tableName" => $tableName]);
        }
        if(!$dictionaryTableNames){
            abort(404);
        }

        return view('dictionary');
    }

    public function store(Request $request){
        $request->validate([
            'modalInput' => ['required','string','max:40','min:2']
        ],
        [
            'required' => "A mező kitöltése kötelező",
            'string' => "Csak karakterlánct lehet megadni.",
            'min' => "Legalább 2 karakternél nagyobb kell lenni vagy üresen hagyni a mezőt.",
            'max' => "Legfeljebb 40 karaktert lehet megadni."
        ]);

        $result = DictionaryTableNames::insertTableNameIfNotSame(Auth::user()->id,$request->input('modalInput'));
        if ($result) return response()->json('Sikeres mentés',201);
        if ($result == 0) return response()->json(["message" =>"Létezik ez a tábla név."],409);
        return response()->json("Sikertelen mentés",500);

    }

    public function storeCells(Request $request){
        self::customValidate($request);

        $request = $request->all();
        $dictionaryTableNames = DictionaryTableNames::where('tableName',$request['tableName'])->where('user_id',Auth::user()->id)->first();

        if(!$dictionaryTableNames) return response("Nem létezik ilyen szótár név",404);

        $dictionaryTableValues = DictionaryTableValues::firstOrCreate([
            'user_id' => Auth::user()->id,
            'tableName' => $request['tableName'],
            'tableID' => $dictionaryTableNames->id,
            'english' => $request['english'],
            'hungarian1' => $request['hun1'],
            'hungarian2' => $request['hun2'],
            'hungarian3' => $request['hun3'],
        ]);

        if ($dictionaryTableValues->wasRecentlyCreated) return response()->json('Sikeres mentés',200);

        if( !$dictionaryTableValues->wasRecentlyCreated) return response()->json('Ezek az adatok már léteznek',409);

        return(response()->json("Valami hiba törtétnt",500));
    }

    public function update(Request $request){
        self::customValidate($request);
        $request = $request->all();
        $dictionaryTableNames =  DictionaryTableNames::existsTableNameByUserId($request['tableName'],Auth::user()->id);

        if(!$dictionaryTableNames) return response("Nem létezik ilyen szótár név",404);

        $result = $dictionaryTableNames->searchRow(
            $request['tableName'],
            $request['originalEnglish'],
            $request['originalHun1'],
            $request['originalHun2'],
            $request['originalHun3']
        );

        if (!$result) return response()->json('A rekord nem létezik',404);

        $result->english = $request['english'];
        $result->hungarian1 = $request['hun1'];
        $result->hungarian2 = $request['hun2'];
        $result->hungarian3 = $request['hun3'];

        if ($result->save()) return response()->json("Sikeres frissités",200);

        return response()->json("Sikeretelen frissités",400);
    }

    public function destroy(Request $request){
        self::customValidate($request);

        $request = $request->all();
        $dictionaryTableNames =  DictionaryTableNames::existsTableNameByUserId($request['tableName'],Auth::user()->id);

        if(!$dictionaryTableNames) return response("Nem létezik ilyen szótár név",404);

        $result = $dictionaryTableNames->searchRow(
            $request['tableName'],
            $request['english'],
            $request['hun1'],
            $request['hun2'],
            $request['hun3']
        );

        if (!$result) return response()->json('A rekord nem létezik',404);

        if ($result->delete()) return response()->json("Sikeres törlés",200);

        return response()->json("Sikeretelen törlés",400);
    }

    public function destroyDictionary(Request $request){
        $request->validate([
            'dictionary' => ['required','string','max:40','min:2']
        ],
        [
            'required' => "Nincs megadva a szótár neve.",
        ]);
        $request = $request->all();

        $dictionaryTableNames =  DictionaryTableNames::existsTableNameByUserId($request['dictionary'],Auth::user()->id);
        if (!$dictionaryTableNames) return response()->json("Nem létezik ilyen szótár név.",404);

        $dictionaryTableNames= DictionaryTableNames::where('user_id',Auth::user()->id)->where('tableName',$request['dictionary'])->first();

        if($dictionaryTableNames->delete()) return response()->json("Sikeres törlés",200);
        else return response()->json("Sikertelen törlés",500);
    }

}
