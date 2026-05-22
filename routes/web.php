<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntretienController;
use App\Http\Controllers\FichierController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     Route::resource('candidatures', CandidatureController::class);

    Route::prefix('archives')->name('archives.')->group(function () {
        Route::get('/', [ArchiveController::class, 'index'])
            ->name('index');

        Route::post('{id}/restore', [ArchiveController::class, 'restore'])
            ->name('restore');
    });

    Route::post(
        'candidatures/{candidature}/entretiens',
        [EntretienController::class, 'store']
    )->name('entretiens.store');

    Route::resource('entretiens', EntretienController::class)
        ->except(['index', 'create', 'show']);
        
    
     Route::post(
        'candidatures/{candidature}/fichiers',
        [FichierController::class, 'store']
    )->name('fichiers.store');

    Route::delete(
        'fichiers/{fichier}',
        [FichierController::class, 'destroy']
    )->name('fichiers.destroy');

    Route::get(
        'fichiers/{fichier}/download',
        [FichierController::class, 'download']
    )->name('fichiers.download');

});

require __DIR__.'/auth.php';
