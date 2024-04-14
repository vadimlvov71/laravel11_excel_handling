<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileHandlerController;
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [FileHandlerController::class, 'index']);
//Route::post('/import', [FileHandlerController::class, 'import']);
Route::get('/import', [FileHandlerController::class, 'import']);
Route::get('/list', [ItemsController::class, 'import']);