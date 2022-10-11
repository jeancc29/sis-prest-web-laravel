<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get("acceder", [\App\Http\Controllers\UserController::class, "acceder"]);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::resource('cuentas', \App\Http\Controllers\CuentaController::class);
    Route::resource('bancos', \App\Http\Controllers\BancoController::class);
    Route::post("/cajas/abrir", [\App\Http\Controllers\UserController::class, "acceder"]);
    Route::resource('cajas', \App\Http\Controllers\CajaController::class);
    Route::get("dashboard", [\App\Http\Controllers\DashboardController::class, "index"]);
});
