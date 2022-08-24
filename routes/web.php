<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EleitorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/eleitores', [EleitorController::class, 'index']);
Route::get('/eleitores/show/{id}', [EleitorController::class, 'show'])->where('id', '[0-9]+');
Route::get('/eleitores/create', [EleitorController::class, 'create']);
Route::post('/eleitores/store', [EleitorController::class, 'store']);
Route::get('/eleitores/edit/{id}', [EleitorController::class, 'edit'])->where('id', '[0-9]+');
Route::post('/eleitores/update', [EleitorController::class, 'update']);
Route::get('/eleitores/destroy/{id}', [EleitorController::class, 'destroy'])->where('id', '[0-9]+');
