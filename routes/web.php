<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EleitorController;
use App\Http\Controllers\VotoController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\PeriodoController;

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


Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/eleitores', [EleitorController::class, 'index'])->name('index');
Route::get('/eleitores/show/{id}', [EleitorController::class, 'show'])->where('id', '[0-9]+');
Route::get('/eleitores/create', [EleitorController::class, 'create']);
Route::post('/eleitores/store', [EleitorController::class, 'store']);
Route::get('/eleitores/edit/{id}', [EleitorController::class, 'edit'])->where('id', '[0-9]+');
Route::post('/eleitores/update', [EleitorController::class, 'update']);
Route::get('/eleitores/destroy/{id}', [EleitorController::class, 'destroy'])->where('id', '[0-9]+');

Route::get('/votos', [VotoController::class, 'index']);
Route::get('/votos/create', [VotoController::class, 'create'])->name('votar')->middleware('voto');
Route::post('/votos/store', [VotoController::class, 'store'])->middleware('voto');
Route::get('/votos/titulo', [VotoController::class, 'titulo']);
Route::post('/votos/validar', [VotoController::class, 'validar']);
Route::post('/votos/confirmar', [VotoController::class, 'confirmar'])->middleware('voto');
Route::post('/votos/comprovante', [VotoController::class]);
Route::get('/votos/resultados', [VotoController::class, 'resultados']);

Route::get('/periodos', [PeriodoController::class, 'index']);
Route::get('/periodos/create', [PeriodoController::class, 'create']);
Route::post('/periodos/store', [PeriodoController::class, 'store']);
Route::get('/periodos/edit/{id}', [PeriodoController::class, 'edit'])->where('id', '[0-9]+');
Route::post('/periodos/update', [PeriodoController::class, 'update']);
Route::get('/periodos/destroy/{id}', [PeriodoController::class, 'destroy'])->where('id', '[0-9]+');

Route::get('/candidatos', [CandidatoController::class, 'index']);
Route::get('/candidatos/create', [CandidatoController::class, 'create']);
Route::post('/candidatos/store', [CandidatoController::class, 'store']);
Route::get('/candidatos/edit/{id}', [CandidatoController::class, 'edit'])->where('id', '[0-9]+');
Route::post('/candidatos/update', [CandidatoController::class, 'update']);
Route::get('/candidatos/destroy/{id}', [CandidatoController::class, 'destroy'])->where('id', '[0-9]+');

