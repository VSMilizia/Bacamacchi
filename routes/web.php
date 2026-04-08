<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'))->name('home');
Route::get('/teatro', fn () => view('pages.teatro'))->name('teatro');
Route::get('/cunta-cuentos', fn () => view('pages.cunta-cuentos'))->name('cunta-cuentos');
Route::get('/attivita', fn () => view('pages.attivita'))->name('attivita');
Route::get('/chi-sono', fn () => view('pages.chi-sono'))->name('chi-sono');
Route::get('/calendario', fn () => view('pages.calendario'))->name('calendario');
Route::get('/contatti', fn () => view('pages.contatti'))->name('contatti');
