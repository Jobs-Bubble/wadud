<?php

use App\Http\Controllers\App\Company\BusinessTypeController;
use App\Http\Controllers\App\Company\CompanyDetailController;
use App\Http\Controllers\App\Company\CompanyLocationController;
use App\Http\Controllers\App\Company\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'app', 'middleware' => ['permission'], 'as' => 'app_permission.'], function () {
    Route::apiResource('business-type', BusinessTypeController::class);
    // Route::apiResource('career-page', CareerPageController::class);
    Route::apiResource('company-details', CompanyDetailController::class);
    Route::apiResource('company-location', CompanyLocationController::class);
    Route::apiResource('department', DepartmentController::class);
    
});