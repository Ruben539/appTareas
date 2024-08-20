<?php

use App\Http\Controllers\EstadoControllers;
use App\Http\Controllers\TareaControllers;
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



//TODO: Apis Rest para el manejo de las acciones de la app.
Route::prefix('app')->group(function () {

    //FIXME: Apis para el manejo del login a la aplicacion y al resgitro.
    Route::prefix('auth')->group(function () {
       
    });

    //FIXME: Apis Rest para el manejo de las acciones de las tareas.
    Route::prefix('tareas')->group(function () {
        Route::get('/listado', [TareaControllers::class, 'index']);
        Route::post('/crear', [TareaControllers::class, 'store']);
        Route::put('/actualizar/{id}', [TareaControllers::class, 'update']);
        Route::put('/actualizar-estado/{id}/{estado}', [TareaControllers::class, 'updateEstado']);
        Route::delete('/eliminar/{id}', [TareaControllers::class, 'destroy']);

        //TODO: Contador de estados del registro.
        Route::get('/count-pendiente', [TareaControllers::class, 'cantidadPendiente']);
        Route::get('/count-proceso', [TareaControllers::class, 'cantidadProceso']);
        Route::get('/count-terminados', [TareaControllers::class, 'cantidadTerminado']);
    });

    //FIXME: Apis para el manejo de las acciones de los estados.
    Route::prefix('estados')->group(function () {
        Route::get('/estados', [ EstadoControllers::class, 'index']);
        Route::post('/crear', [ EstadoControllers::class, 'store']);
        Route::put('/actualizar/{id}', [ EstadoControllers::class, 'update']);
        Route::delete('/eliminar/{id}', [ EstadoControllers::class, 'destroy']);
    });
});
