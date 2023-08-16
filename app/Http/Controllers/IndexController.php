<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DictionaryTableNames;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        if (auth()->check()){
            $tableNames = DictionaryTableNames::tableNamesByUser(Auth::user()->id);
            return view('index',['tableNames' => $tableNames]);
        }
        else{
            return view('index',['tableNames' => 0]);
        }
    }
}
