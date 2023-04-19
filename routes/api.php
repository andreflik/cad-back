<?php


use App\Http\Controllers\PessoasController;
use Illuminate\Support\Facades\Route;

Route::get('/pessoas', [PessoasController::class, 'index']);
Route::post('/pessoas/create', [PessoasController::class, 'create']);
Route::put('/pessoas/{id}', [PessoasController::class, 'edit']);
Route::delete('/pessoas/{id}', [PessoasController::class, 'destroy']);


