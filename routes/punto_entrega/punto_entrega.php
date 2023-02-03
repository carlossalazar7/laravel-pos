<?php

use App\Http\Controllers\API\PuntoEntregaController;
use Illuminate\Support\Facades\Route;

Route::get('punto_entrega', [PuntoEntregaController::class, 'index']);
Route::post('/punto_entrega/store', [PuntoEntregaController::class, 'store'])->middleware('permissions:can_manage_punto_entrega');
Route::post('punto_entrega/delete/{id}', [PuntoEntregaController::class, 'destroy']);
Route::post('punto_entrega/{id}', [PuntoEntregaController::class, 'update'])->middleware('permissions:can_manage_punto_entrega');
Route::get('punto_entrega/{id}', [PuntoEntregaController::class, 'show']);

Route::post('puntos_entrega', [PuntoEntregaController::class, 'getAllPuntosEntrega']);
Route::get('/get-puntos-entrega', [PuntoEntregaController::class, 'getPuntosEntrega']);