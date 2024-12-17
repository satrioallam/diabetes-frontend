<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiabetesController;
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [DiabetesController::class, 'showIntro'])->name('diabetes.start');
// Route::post('/', [DiabetesController::class, 'saveUserData']);
// Route::get('/diabetes/questionnaire', [DiabetesController::class, 'showQuestionnaire'])->name('diabetes.questionnaire');
// Route::post('/diabetes/process-questionnaire', [DiabetesController::class, 'processQuestionnaire'])->name('diabetes.processQuestionnaire');
// Route::post('/diabetes/result', [DiabetesController::class, 'processQuestionnaire'])->name('diabetes.result');
// Route::get('/', [DiabetesController::class, 'showIntro'])->name('diabetes.start');
// Route::post('/', [DiabetesController::class, 'saveUserData'])->name('diabetes.saveUserData');
// Route::get('/diabetes/questionnaire', [DiabetesController::class, 'showQuestionnaire'])->name('diabetes.questionnaire');
// Route::post('/diabetes/process-questionnaire', [DiabetesController::class, 'processQuestionnaire'])->name('diabetes.processQuestionnaire');
// Route::get('/diabetes/result', [DiabetesController::class, 'showResult'])->name('diabetes.result');

// Rute untuk menampilkan form data diri
Route::get('/', [DiabetesController::class, 'showIntro'])->name('diabetes.start');

// Rute untuk menyimpan data diri pengguna
Route::post('/', [DiabetesController::class, 'saveUserData'])->name('diabetes.saveUserData');

// Rute untuk menampilkan kuesioner
Route::get('/diabetes/questionnaire/{user_id}', [DiabetesController::class, 'showQuestionnaire'])->name('diabetes.questionnaire');

// Rute untuk memproses kuesioner
Route::post('/diabetes/process-questionnaire/{user_id}', [DiabetesController::class, 'saveAnswers'])->name('diabetes.saveAnswer');

// Rute untuk menampilkan hasil
Route::get('/diabetes/result/{user_id}', [DiabetesController::class, 'showResult'])->name('diabetes.result');
