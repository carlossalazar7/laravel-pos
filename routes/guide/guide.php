<?php

use App\Http\Controllers\API\GuideController;
use Illuminate\Support\Facades\Route;

//Route::get('guide', [GuideController::class, 'index'])->middleware('permissions:can_manage_sales');
Route::post('guides', [GuideController::class, 'getAllGuides']);
Route::get('guide/{id}', [GuideController::class, 'show']);
Route::get('guideData/{id}', [GuideController::class, 'showData']);

Route::post('guide/store', [GuideController::class, 'store'])->middleware('permissions:can_manage_guides');
Route::post('guide/{id}', [GuideController::class, 'update'])->middleware('permissions:can_manage_guides');
Route::post('guide/delete/{id}', [GuideController::class, 'destroy'])->middleware('permissions:can_manage_guides');
Route::post('closeGuide/{id}', [GuideController::class, 'closeGuide'])->middleware('permissions:can_manage_guides');


Route::get('guide', [GuideController::class, 'guide'])->middleware('permissions:can_manage_guides');
Route::get('/generate-pdf-guide/{id}', [GuideController::class, 'generatePDF'])->middleware('permissions:can_manage_guides');;
//Route::get('guides', [GuideController::class, 'index'])->middleware('permissions:can_manage_guides');
