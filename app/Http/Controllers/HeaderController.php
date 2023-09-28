<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DictionaryTableNames;
use Illuminate\Support\Facades\Auth;

class HeaderController extends Controller
{
    public function show(){
        if (auth()->check()){
            $tableNames = DictionaryTableNames::tableNamesByUser(Auth::user()->id);
            return response()->json(['tableNames' => $tableNames],200);
        }
        return response()->json(['tableNames' => 0],200);
    }
}
