<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryTableNames extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tableName'
    ];

    public $timestamps = false;

    public function dictionaryTableValues($tableName){
        return $this->hasMany(DictionaryTableValues::class,'user_id','user_id')
        ->where('tableName',$tableName)
        ->get();
    }


    public static function tableNamesByUser(string $userID){
        $results = self::where('user_id', $userID)->pluck('tableName');
        return $results->isEmpty() ? 0 : $results;
    }

    /**
     * Inserts the user_id and table name to the database, if not exits.
     *
     * @param integer $user_id
     * @param string $table_name
     * @return 1 if insertion is successfull else 0
     */
    public static function insertTableNameIfNotSame(int $user_id, string $table_name){
        $result = self::where('user_id', $user_id)
        ->where('tableName',$table_name)
        ->exists();

        if(!$result){
            $dictionaryTableName = new DictionaryTableNames();
            $dictionaryTableName->user_id = $user_id;
            $dictionaryTableName->tableName = $table_name;
            $dictionaryTableName->save();
            return 1;
        }
        return 0;
    }


    public static function existsTableNameByUserId($tableName,$user_id){
        return DictionaryTableNames::where('tableName',$tableName)->where('user_id',$user_id)->first();
    }

    public function searchRow($tableName,$english,$hun1,$hun2,$hun3){
        return $this->hasMany(DictionaryTableValues::class,'user_id','user_id')
        ->where('tableName',$tableName)
        ->where('english',$english)
        ->where('hungarian1',$hun1)
        ->where('hungarian2',$hun2)
        ->where('hungarian3',$hun3)
        ->first();
    }

}
