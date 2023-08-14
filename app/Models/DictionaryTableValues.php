<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryTableValues extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tableName',
        'english',
        'hungarian1',
        'hungarian2',
        'hungarian3',
        'hungarina4',
        'correct_point',
        'incorrect_point',
        'proportionality',
    ];

    public $timestamps = false;

    public function dictionaryTableNames(){
        return $this->belongsTo(DictionaryTableNames::class,'user_id','user_id');
    }

    public static function selectEnglishWord($user_id,$dictionaryName,$word){
        return self::where('user_id',$user_id)
        ->where('tableName',$dictionaryName)
        ->where('hungarian1',$word)
        ->pluck('english');
    }

    public static function selectHungarianWords($user_id,$dictionaryName,$word){
        return self::where('user_id',$user_id)
        ->where('tableName',$dictionaryName)
        ->where('english',$word)
        ->select('hungarian1','hungarian2','hungarian3')
        ->get()
        ->toArray();
    }

}
