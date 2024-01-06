<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/nama-endpoint', 'NamaController@fungsiGet'); // Contoh GET request
Route::post('/transaction', 'TransactionController@addTransaction'); // Contoh POST request
Route::put('/transaction/{id}', 'TransactionController@updateTransaction');
// Dan seterusnya untuk HTTP verbs lainnya (PUT, DELETE, dll.)
