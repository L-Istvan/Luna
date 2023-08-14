<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\PracticingWrodsController;

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

Route::get('/', function () {
    return view('index');
});


Route::get('login',function(){
    return view('auth/login');
})->name('login');

Route::get('test', function () {
    return view('test');
});

Route::get('register', function(){
    return view(('auth/register'));
})->name('register');

Route::middleware('auth')->group(function () {

    Route::get('index',function () {
        return view('index');
    });
    Route::post('chatInput',[ChatController::class,'chat']);
    Route::get('chat/tanult_szavak', [ChatController::class,'practicingLearnedWords'])->name('chat.practicingLearnedWords');

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

    Route::post('sendDictionaryName',[PracticingWrodsController::class,'showLearnedWords'])->name('practicingWords.learnedWords');
    Route::get('szotarbol_szavak_gyakorlas/{szotar}',[PracticingWrodsController::class,'index'])->name('practicingWords.index');
    Route::post('AIHelp',[PracticingWrodsController::class,'AIHelp'])->name('practicingWords.AIHelp');
    Route::get('ismeretlen_szavak_gyakorlas',[PracticingWrodsController::class,'index'])->name('practicingWords.unknownWords');

    Route::get('chat/idegen_szavak',[ChatController::class,'practicingUnknownWords'])->name('chat.practicingUnknownWords');
    Route::get('chat/kerdes_felteves',[ChatController::class,'answersToQuestions'])->name('chat.answersToQuestions');
    Route::get('chat/kersesre_valasz',[ChatController::class,'askingQuestion'])->name('chat.askingQuestion');
    Route::get('chat/mondat_ellenorzes',[ChatController::class,'sentenceCheck'])->name('chat.sentenceCheck');
    Route::get('chat/kifejezes',[ChatController::class,'phraseLearning'])->name('chat.phraseLearning');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
