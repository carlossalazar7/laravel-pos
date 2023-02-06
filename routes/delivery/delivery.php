<?php

use App\Http\Controllers\API\DeliveryController;
use Illuminate\Support\Facades\Route;

Route::get('delivery', [DeliveryController::class, 'index']);
Route::post('/delivery/store', [DeliveryController::class, 'store'])->middleware('permissions:can_manage_deliveries');
Route::post('delivery/delete/{id}', [DeliveryController::class, 'destroy']);
Route::post('delivery/{id}', [DeliveryController::class, 'update'])->middleware('permissions:can_manage_deliveries');
Route::get('delivery/{id}', [DeliveryController::class, 'show']);

Route::post('deliveries', [DeliveryController::class, 'getAllDeliveries']);