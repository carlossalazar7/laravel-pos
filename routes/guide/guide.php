<?php

use App\Http\Controllers\API\GuideController;
use Illuminate\Support\Facades\Route;

Route::get('guide', [GuideController::class, 'index'])->middleware('permissions:can_manage_sales');
Route::post('guides', [GuideController::class, 'getAllGuides']);
Route::get('guide/{id}', [GuideController::class, 'show']);
Route::post('guide/store', [GuideController::class, 'store'])->middleware('permissions:can_manage_sales');
Route::post('guide/{id}', [GuideController::class, 'update'])->middleware('permissions:can_manage_sales');
Route::post('guide/delete/{id}', [GuideController::class, 'destroy']);


/*Route::get('/get-departamentos', [DepartamentoController::class, 'getDepartamentos']);
Route::get('/get-municipios-departamentoId/{department_id}', [MunicipioController::class, 'getMunicipiosByDepId']);*/