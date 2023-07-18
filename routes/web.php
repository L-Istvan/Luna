<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('login',function(){
    return view('auth/login')->name('login');
});


Route::get('register',function(){
    return view(('auth/register'))->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('index',function () {
        return view('index');
    });
    Route::get('chat/tanult_szavak', [ChatController::class,'practicingLearnedWords'])->name('chat.practicingLearnedWords');
    Route::get('chat/olvasas',[ChatController::class,'readingFromLearnedWords'])->name('chat.readingFromLearnedWords');
    Route::get('chat/idegen_szavak',[ChatController::class,'practicingUnknownWords'])->name('chat.practicingUnknownWords');
    Route::get('chat/szotar',[ChatController::class,'createNewDictionary'])->name('chat.createNewDictionary');
    Route::get('chat/kerdes_felteves',[ChatController::class,'answersToQuestions'])->name('chat.answersToQuestions');
    Route::get('chat/kersesre_valasz',[ChatController::class,'askingQuestion'])->name('chat.askingQuestion');
    Route::get('chat/mondat_ellenorzes',[ChatController::class,'sentenceCheck'])->name('chat.sentenceCheck');
    Route::get('chat/kifejezes',[ChatController::class,'phraseLearning'])->name('chat.phraseLearning');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
