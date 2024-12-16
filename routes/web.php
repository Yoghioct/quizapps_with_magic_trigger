<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('leaderboard');
// });

Route::get('/', [LeaderboardController::class, 'index'])->name('home');

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
Route::get('/leaderboard', [LeaderboardController::class, 'leaderboard'])->middleware(['auth', 'verified'])->name('leaderboard');

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

require __DIR__.'/auth.php';
