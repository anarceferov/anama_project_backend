<?php

use App\Http\Controllers\AboutCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChronologyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\ImsmaController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LegislationController;
use App\Http\Controllers\NationalStandartCategoryController;
use App\Http\Controllers\NationalStandartController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PhotoFolderController;
use App\Http\Controllers\PressController;
use App\Http\Controllers\ProcessesController;
use App\Http\Controllers\ProcessIconController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\SubPagesController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WorkAboutController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TrainingCategoryController;
use App\Http\Controllers\TrainingController;

// FrontEnd Route

// Route::middleware('locale')->group(function() {
//     Route::get('/' , HomeController::class);
// });

Route::apiResource('trainings', TrainingController::class)->only('store');
Route::apiResource('pages', PageController::class)->only('index');
Route::apiResource('rules', RuleController::class)->only('index');
Route::apiResource('sub/pages', SubPagesController::class)->only('index');
Route::apiResource('work/abouts', WorkAboutController::class)->only('index');
Route::apiResource('videos', VideoController::class)->only('index');
Route::apiResource('presses', PressController::class)->only('index');
Route::apiResource('processesIcons', ProcessIconController::class)->only('index');
Route::apiResource('processes', ProcessesController::class)->only('index');
Route::apiResource('qualities', QualityController::class)->only('index');
Route::apiResource('imsmas', ImsmaController::class)->only('index');
Route::apiResource('chronologies', ChronologyController::class)->only('index');
Route::apiResource('employees', EmployeeController::class)->only('index');
Route::apiResource('languages', LanguageController::class)->only('index');
Route::apiResource('legislations', LegislationController::class)->only('index');
Route::apiResource('abouts', AboutController::class)->only('index');
Route::apiResource('about/categories', AboutCategoryController::class)->only('index');
Route::apiResource('national/standarts', NationalStandartController::class)->only('index');
Route::apiResource('national/standart/categories', NationalStandartCategoryController::class)->only('index');
Route::apiResource('news', NewsController::class)->only('index');
Route::apiResource('news/categories', NewsCategoryController::class)->only('index');
Route::apiResource('trainings', TrainingController::class)->only('index');
Route::apiResource('training/categories', TrainingCategoryController::class)->only('index');
Route::apiResource('photos', PhotoController::class)->only('index');
Route::apiResource('photo/folders', PhotoFolderController::class)->only('index');
Route::apiResource('projects', ProjectController::class)->only('index');
Route::apiResource('project/categories', ProjectCategoryController::class)->only('index');


//BackEnd Route
Route::post('admin/login', [AuthController::class, 'login'])->name('login');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::apiResource('pages', PageController::class);
    Route::apiResource('rules', RuleController::class);
    Route::apiResource('sub/pages', SubPagesController::class);
    Route::apiResource('work/abouts', WorkAboutController::class);
    Route::apiResource('videos', VideoController::class);
    Route::apiResource('presses', PressController::class);
    Route::apiResource('processesIcons', ProcessIconController::class);
    Route::apiResource('processes', ProcessesController::class);
    Route::apiResource('qualities', QualityController::class);
    Route::apiResource('imsmas', ImsmaController::class);
    Route::apiResource('chronologies', ChronologyController::class);
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('languages', LanguageController::class);
    Route::apiResource('legislations', LegislationController::class);
    Route::apiResource('abouts', AboutController::class);
    Route::apiResource('about/categories', AboutCategoryController::class);
    Route::apiResource('national/standarts', NationalStandartController::class);
    Route::apiResource('national/standart/categories', NationalStandartCategoryController::class);
    Route::apiResource('news', NewsController::class);
    Route::apiResource('news/categories', NewsCategoryController::class);
    Route::apiResource('trainings', TrainingController::class);
    Route::apiResource('training/categories', TrainingCategoryController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('project/categories', ProjectCategoryController::class);
    Route::apiResource('photos', PhotoController::class);
    Route::apiResource('photo/folders', PhotoFolderController::class);
    Route::post("/image", [FileController::class, "uploadSingleImage"]);
    Route::post("/file", [FileController::class, "uploadFile"]);
});
