<?php

use App\Http\Controllers\API\GuideController;
use Illuminate\Support\Facades\Route;

Route::get('guides', [GuideController::class, 'index'])->middleware('permissions:can_manage_sales');
