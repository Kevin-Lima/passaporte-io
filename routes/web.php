<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController; 
use Illuminate\Support\Facades\Route;

//Rota inicial pública
Route::get('/', [EventController::class, 'index'])->name('home');

//Dashboard protegido (Para Organizadores e Participantes)
Route::get('/dashboard', [EventController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//Rotas do Organizado
Route::middleware(['auth', 'organizer'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

//Rota Pública de Detalhes (Colocada aqui embaixo propositalmente)
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show'); 

//Rotas para utilizadores logados (Inscrições e Perfil do Breeze)
Route::middleware('auth')->group(function () {
    
    // Inscrição e Cancelamento
    Route::post('/events/{event}/attend', [EventController::class, 'attend'])->name('events.attend');
    Route::delete('/events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');

    // Extras do Breeze (Perfil do usuário)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';