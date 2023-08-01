<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryTableValues extends Model
{
    use HasFactory;

    protected $fillable = [
        'tableName',
        'english',
        'hungarian1',
        'hungarian2',
        'hungarian3'
    ];

    public $timestamps = false;

    public function DictionaryTableNames(){
        return $this->belongsTo(DictionaryTableNames::class,'tableName','tableName');
    }
}
