<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Test;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\UsuarioController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('centros',[CentroController::class, 'getCentros']);
Route::get('centro/{id}',[CentroController::class, 'getCentro']);

Route::post('/registrarCentro',[CentroController::class, 'registroCentro']);
Route::post('/registrarUsuario',[UsuarioController::class, 'registroUsuario']);

Route::get('usuarios',[HomeController::class, 'getUsuarios']);
Route::get('usuario/{id}',[HomeController::class, 'getUsuario']);


Route::get('misPuntos',[UsuarioController::class, 'getPuntos']);

Route::get('productosNuevos',[CentroController::class, 'getNuevos']);
Route::get('productosReciclados',[CentroController::class, 'getReciclados']);


Route::post('loginUsuario',[UsuarioController::class, 'login']);
