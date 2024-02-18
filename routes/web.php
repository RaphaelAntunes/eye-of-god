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


Route::post('/ativar-vip', [App\Http\Controllers\MemberController::class, 'ativarvip'])->name('ativar-vip');
Route::post('/usr-info', [App\Http\Controllers\MemberController::class, 'buscarusr'])->name('buscar-usr');
Route::post('/login', [App\Http\Controllers\MemberController::class, 'login'])->name('login');
Route::post('/cadastro', [App\Http\Controllers\MemberController::class, 'cadastro'])->name('cadastro');
Route::post('/cadastro-senha', [App\Http\Controllers\MemberController::class, 'cadastrosenha'])->name('cadastro-senha');
Route::get('/logout', [App\Http\Controllers\MemberController::class, 'logout'])->name('logout');


Route::get('/api/placa/{id}', [ApiController::class, 'Consulta']);
Route::get('/api/d/{placa}', [ApiController::class, 'get_d_dados']);


Route::get('/api/token', [ApiController::class, 'api_token']);
Route::get('/api/captcha', [ApiController::class, 'captcha_get']);


//Route::get('/api/d/{tipo}/{placa}', [ApiController::class, 'get_d_dados']);


Route::post('', [ApiController::class, 'Consulta']);
