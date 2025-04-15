<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\RankingController;

Route::get('/', function () {
    return redirect()->route('ranking.index');
});

Route::resource('criteria', CriteriaController::class);
Route::resource('alternatives', AlternativeController::class);
Route::get('scores', [ScoreController::class, 'index'])->name('scores.index');
Route::get('scores/create', [ScoreController::class, 'create'])->name('scores.create');
Route::post('scores', [ScoreController::class, 'store'])->name('scores.store');

Route::get('ranking', [RankingController::class, 'index'])->name('ranking.index');
Route::get('ranking/export-pdf', [RankingController::class, 'exportPdf'])->name('ranking.exportPdf');
