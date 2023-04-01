<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);


Route::middleware('auth:sanctum')->group( function () {
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/notes', [NotesController::class, 'index']);
    Route::get('/note/{id}', [NotesController::class, 'show']);
    Route::put('/note/{id}', [NotesController::class, 'update']);
    Route::post('/note', [NotesController::class, 'store']);
    Route::delete('/note/{id}', [NotesController::class, 'destroy']);
    Route::post('/note/search', [NotesController::class, 'search']);
});
