<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Support\Facades\Route;

Route::get('route', [RouteController::class, 'index']);
Route::post('/route/store', [RouteController::class, 'store'])->middleware('permissions:can_manage_routes');
Route::post('route/delete/{id}', [RouteController::class, 'destroy']);
Route::post('route/{id}', [RouteController::class, 'update'])->middleware('permissions:can_manage_routes');
Route::get('route/{id}', [RouteController::class, 'show']);

Route::post('routes', [RouteController::class, 'getAllRoutes']);
Route::get('/get-routes', [RouteController::class, 'getRoutes']);