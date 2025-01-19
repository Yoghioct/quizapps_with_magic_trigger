<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});


// Route::get('/', [LeaderboardController::class, 'index'])->name('home');

// Route::get('/', [LeaderboardController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/score', function () {
//     return view('score');
// })->middleware(['auth', 'verified'])->name('score');

// Route::get('/data-score', function () {
//     return view('data-score');
// })->middleware(['auth', 'verified'])->name('data-score');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/score', [ScoreController::class, 'index'])->middleware(['auth', 'verified'])->name('score');
Route::get('/data-score', [ScoreController::class, 'data'])->middleware(['auth', 'verified'])->name('data-score');
Route::get('/leaderboard', [LeaderboardController::class, 'leaderboard'])->name('leaderboard');
Route::get('/leaderboard/{id}', [LeaderboardController::class, 'detail'])->name('detail-leaderboard');
Route::get('/participant', [ParticipantController::class, 'index'])->middleware(['auth', 'verified'])->name('participant');


// Route::get('/data-score', [ScoreController::class, 'data'])
//     ->middleware(['auth', 'verified'])
//     ->name('scores.data');

Route::get('/data-score/edit/{id}', [ScoreController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('scores.edit');

Route::post('/data-score/update/{id}', [ScoreController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('scores.update');

Route::delete('/data-score/{id}', [ScoreController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('scores.destroy');



Route::post('/score', [ScoreController::class, 'store'])->name('score.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/amazing-race', [ParticipantController::class, 'amazingRace'])->name('amazingrace');
Route::post('/amazing-race/register', [ParticipantController::class, 'amazingRaceRegister'])->name('amazingrace.register');
Route::get('/amazing-race/detail/{id}', [ParticipantController::class, 'amazingRaceDetail'])->name('amazingrace.detail');
Route::get('/amazing-race/leaderboard', [LeaderboardController::class, 'index'])->name('amazingrace.leaderboard');


Route::get('/gala-dinner', [ParticipantController::class, 'galaDinner'])->name('galadinner');
Route::post('/gala-dinner/register', [ParticipantController::class, 'galaDinnerRegister'])->name('galadinner.register');
Route::get('/gala-dinner/detail/{id}', [ParticipantController::class, 'galaDinnerDetail'])->name('galadinner.detail');



require __DIR__.'/auth.php';




