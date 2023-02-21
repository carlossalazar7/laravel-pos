<?php

use App\Http\Controllers\API\GuideController;
use Illuminate\Support\Facades\Route;

Route::get('guide', [GuideController::class, 'guide'])->middleware('permissions:can_manage_guides');
Route::get('guides', [GuideController::class, 'index'])->middleware('permissions:can_manage_guides');
