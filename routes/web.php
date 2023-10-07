<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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
    return view('home');
});

Route::post('/free-test', [App\Http\Controllers\FreeTestController::class, 'index'])->name('free-test');
Route::post('api/free-test', [App\Http\Controllers\FreeTestController::class, 'autorizador'])->name('api-free-test');

Route::get('/api/placa/{id}', [ApiController::class, 'Consulta']);
Route::post('', [ApiController::class, 'Consulta']);
