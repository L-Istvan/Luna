<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\PracticingWrodsController;
use App\Http\Controllers\practicingUnknownWordsController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SentenceCheckController;
use App\Http\Controllers\HeaderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[IndexController::class,'index'])->name('index');

Route::get('login',function(){
    return view('auth/login');
})->name('login');

Route::get('register', function(){
    return view(('auth/register'));
})->name('register');

Route::get('info',function(){
    return view('info');
})->name('info');

Route::get('header',[HeaderController::class,'show'])->name('header.getTableNames');

Route::middleware('auth')->group(function () {

    Route::get('index',[IndexController::class,'index']);

    Route::get('olvasas/valasztas',[ReadingController::class,'selectionPageIndex'])->name('reading.selectionPageIndex');
    Route::post('olvasas/szotarbol',[ReadingController::class,'fromDictionaryIndex'])->name('reading.fromDictionaryIndex');
    Route::get('olvasas/megadott_szavakbol',[ReadingController::class,'fromSelectedWordsIndex'])->name('reading.fromSelectedWordsIndex');
    Route::post('generateTextfromDictionary',[ReadingController::class,'generateTextFromSavedWords'])->name('reading.generateTextFromSavedWords');
    Route::post('translateText',[ReadingController::class,'translateText'])->name('reading.translateText');
    Route::post('selectionWords',[ReadingController::class,'generateTextFromSelectedWords'])->name('reading.generateTextFromSelectedWords');

    Route::get('szotar/letrehozas',[DictionaryController::class,'create'])->name('dictionary.create');
    Route::get('szotar/{szerkesztes}',[DictionaryController::class,'edit'])->name('dictionary.edit');
    Route::post('szotar/createTable',[DictionaryController::class,'store'])->name('dictionary.store');
    Route::post('szotar/addCells',[DictionaryController::class,'storeCells'])->name('dictionary.storeCells');
    Route::patch('szotar/updateCells',[DictionaryController::class,'update'])->name('dictionary.update');
    Route::delete('szotar/deleteCells',[DictionaryController::class,'destroy'])->name('dictionary.destroy');
    Route::delete('szotar/deleteDictionary',[DictionaryController::class,'destroyDictionary'])->name('dictionary.destroyDictionary');

    Route::get('szotarbol_szavak_gyakorlas/{szotar}',[PracticingWrodsController::class,'index'])->name('practicingWords.index');
    Route::post('sendDictionaryName',[PracticingWrodsController::class,'show'])->name('practicingWords.show');
    Route::post('AIHelp',[PracticingWrodsController::class,'AIHelp'])->name('practicingWords.AIHelp');
    Route::get('véletlen_szavak_gyakorlas',[practicingUnknownWordsController::class,'index'])->name('practicingUnknownWords.index');
    Route::post('getQuestion',[practicingUnknownWordsController::class,'show'])->name('practicingUnknownWords.show');

    Route::get('kerdes_gyakorlas',[QuestionController::class,'index'])->name('question.index');
    Route::post('getQuestionCorrect',[QuestionController::class,'show'])->name('question.show');

    Route::get('mondat_ellenorzes',[SentenceCheckController::class,'index'])->name('sentenceCheck.index');
    Route::post('getSentenceCorrect',[SentenceCheckController::class,'show'])->name('sentenceCheck.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
