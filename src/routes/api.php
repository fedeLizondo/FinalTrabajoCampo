<?php

use App\Http\Controllers\ProyectoActorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ProyectoDiagramaController;
use App\Http\Controllers\ProyectoDiagramaMensajeController;
use App\Http\Controllers\ProyectoEspecificacionController;
use App\Http\Controllers\ProyectoEspecificacionMensajeController;
use App\Http\Controllers\ProyectoFavoritoController;
use App\Http\Controllers\ProyectoGrupoController;
use App\Http\Controllers\ProyectoMensajeController;
use App\Http\Controllers\UserFavoritoController;
use App\Http\Controllers\UserProyectoController;
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

Route::apiResource('user.favorito', UserFavoritoController::class)->only(['index', 'destroy']);
Route::apiResource('user.proyecto', UserProyectoController::class)->only(['index', 'destroy']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('proyecto.actor', ProyectoActorController::class);
Route::apiResource('proyecto.grupo', ProyectoGrupoController::class);
Route::apiResource('proyecto.diagrama.mensaje', ProyectoDiagramaMensajeController::class);
Route::apiResource('proyecto.diagrama', ProyectoDiagramaController::class);
Route::apiResource('proyecto.especificacion.mensaje', ProyectoEspecificacionMensajeController::class);
Route::apiResource('proyecto.especificacion', ProyectoEspecificacionController::class);
Route::apiResource('proyecto.mensaje', ProyectoMensajeController::class);
Route::apiResource('proyecto.favorito', ProyectoFavoritoController::class)->only(['index', 'store', 'destroy']);
Route::apiResource('proyecto', ProyectoController::class);
