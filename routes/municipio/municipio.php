<?php

use App\Http\Controllers\API\MunicipioController;
use Illuminate\Support\Facades\Route;

Route::get('municipio', [MunicipioController::class, 'index']);
Route::post('/municipio/store', [MunicipioController::class, 'store'])->middleware('permissions:can_manage_municipios');
Route::post('municipio/delete/{id}', [MunicipioController::class, 'destroy']);
Route::post('municipio/{id}', [MunicipioController::class, 'update'])->middleware('permissions:can_manage_municipios');
Route::get('municipio/{id}', [MunicipioController::class, 'show']);


Route::post('municipios', [MunicipioController::class, 'getAllMunicipios']);
Route::get('/get-municipios', [MunicipioController::class, 'getMunicipios']);
Route::get('/get-municipios-departamentoId/{department_id}', [MunicipioController::class, 'getMunicipiosByDepId']);
