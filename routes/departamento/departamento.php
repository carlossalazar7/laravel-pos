<?php

use App\Http\Controllers\API\DepartamentoController;
use App\Http\Controllers\API\MunicipioController;
use Illuminate\Support\Facades\Route;

Route::get('departamento', [DepartamentoController::class, 'index']);
Route::post('/departamento/store', [DepartamentoController::class, 'store'])->middleware('permissions:can_manage_departamentos');
Route::post('departamento/delete/{id}', [DepartamentoController::class, 'destroy']);
Route::post('departamento/{id}', [DepartamentoController::class, 'update'])->middleware('permissions:can_manage_departamentos');
Route::get('departamento/{id}', [DepartamentoController::class, 'show']);

Route::post('departamentos', [DepartamentoController::class, 'getAllDepartamentos']);
Route::get('/get-departamentos', [DepartamentoController::class, 'getDepartamentos']);
Route::get('/get-municipios-departamentoId/{department_id}', [MunicipioController::class, 'getMunicipiosByDepId']);

