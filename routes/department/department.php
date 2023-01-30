<?php

use App\Http\Controllers\API\DepartamentoController;
use Illuminate\Support\Facades\Route;

Route::get('departamento', [DepartamentoController::class, 'index']);
Route::post('/departamento/store', [DepartamentoController::class, 'store'])->middleware('permissions:can_manage_departamentos');
Route::post('departamento/delete/{id}', [DepartamentoController::class, 'destroy']);
Route::post('departamento/{id}', [DepartamentoController::class, 'update'])->middleware('permissions:can_manage_departamentos');
Route::get('departamento/{id}', [DepartamentoController::class, 'show']);

Route::post('departamentos', [DepartamentoController::class, 'getAllDepartments']);
Route::get('/get-departments', [DepartamentoController::class, 'getDepartments']);

