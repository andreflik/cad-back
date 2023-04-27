<?php


use App\Http\Controllers\PessoasController;
use App\Http\Controllers\AutenticarController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AutenticarController::class, 'register']);
Route::post('/login', [AutenticarController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AutenticarController::class, 'logout']);

Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    Route::get('/admin-only', function () {
        return response()->json([
            'message' => 'Somente o admin pode acessar essa rota.'
        ]);
    });
});


Route::get('/pessoas', [PessoasController::class, 'index']);
Route::post('/pessoas', [PessoasController::class, 'create']);
Route::put('/pessoas/{id}', [PessoasController::class, 'edit']);
Route::delete('/pessoas/{id}', [PessoasController::class, 'destroy']);


