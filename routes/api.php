<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChronologyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImsmaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PressController;
use App\Http\Controllers\ProcessesController;
use App\Http\Controllers\ProcessesIconController;
use App\Http\Controllers\QualityController;

Route::post('admin/login', [AuthController::class, 'login'])->name('login');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register' , [AuthController::class, 'register']);
    Route::apiResource('pages' , PageController::class);
    Route::apiResource('abouts' , AboutController::class);
    Route::apiResource('presses' , PressController::class);
    Route::apiResource('processesIcons' , ProcessesIconController::class);
    Route::apiResource('processes' , ProcessesController::class);
    Route::apiResource('qualities' , QualityController::class);
    Route::apiResource('imsmas' , ImsmaController::class);
    Route::apiResource('chronologies' , ChronologyController::class);
    Route::apiResource('employees' , EmployeeController::class);
    Route::post("/image", [FileController::class, "uploadSingleImage"]);
    Route::post("/file", [FileController::class, "uploadFile"]);
});

// Front Route