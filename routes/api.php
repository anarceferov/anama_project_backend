<?php

use App\Http\Controllers\AboutCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AllProjectCategoryController;
use App\Http\Controllers\AllProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChronologyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
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
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegionDataController;
use App\Http\Controllers\SubPagesController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WorkAboutController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TrainingCategoryController;
use App\Http\Controllers\TrainingController;



// FrontEnd Route

Route::middleware('locale')->group(function () {

    Route::apiResource('trainings', TrainingController::class)->only('store');
    Route::apiResource('pages', PageController::class)->only(['index', 'show']);
    Route::apiResource('rules', RuleController::class)->only(['index', 'show']);
    Route::apiResource('sub/pages', SubPagesController::class)->only(['index', 'show']);
    Route::apiResource('work/abouts', WorkAboutController::class)->only(['index', 'show']);
    Route::apiResource('videos', VideoController::class)->only(['index', 'show']);
    Route::apiResource('presses', PressController::class)->only(['index', 'show']);
    Route::apiResource('processesIcons', ProcessIconController::class)->only(['index', 'show']);
    Route::apiResource('processes', ProcessesController::class)->only(['index', 'show']);
    Route::apiResource('qualities', QualityController::class)->only(['index', 'show']);
    Route::apiResource('imsmas', ImsmaController::class)->only(['index', 'show']);
    Route::apiResource('chronologies', ChronologyController::class)->only(['index', 'show']);
    Route::apiResource('employees', EmployeeController::class)->only(['index', 'show']);
    Route::apiResource('languages', LanguageController::class)->only(['index', 'show']);
    Route::apiResource('legislations', LegislationController::class)->only(['index', 'show']);
    Route::apiResource('abouts', AboutController::class)->only(['index', 'show']);
    Route::apiResource('about/categories', AboutCategoryController::class)->only(['index', 'show']);
    Route::apiResource('national/standarts', NationalStandartController::class)->only(['index', 'show']);
    Route::apiResource('national/standart/categories', NationalStandartCategoryController::class)->only(['index', 'show']);
    Route::apiResource('news/categories', NewsCategoryController::class)->only(['index', 'show']);
    Route::apiResource('news', NewsController::class)->only(['index', 'show']);
    Route::apiResource('trainings', TrainingController::class)->only(['index', 'show']);
    Route::apiResource('training/categories', TrainingCategoryController::class)->only(['index', 'show']);
    Route::apiResource('photos', PhotoController::class)->only(['index', 'show']);
    Route::apiResource('photo/folders', PhotoFolderController::class)->only(['index', 'show']);
    Route::apiResource('all/projects', AllProjectController::class)->only(['index', 'show']);
    Route::apiResource('all/project/categories', AllProjectCategoryController::class)->only(['index', 'show']);
    Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);
    Route::apiResource('project/categories', ProjectCategoryController::class)->only(['index', 'show']);
    Route::apiResource('regions', RegionController::class)->only(['index', 'show']);
    Route::apiResource('data/regions', RegionDataController::class)->only(['index', 'show']);
});



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
    Route::apiResource('news/categories', NewsCategoryController::class);
    Route::apiResource('news', NewsController::class);
    Route::apiResource('trainings', TrainingController::class);
    Route::apiResource('training/categories', TrainingCategoryController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('project/categories', ProjectCategoryController::class);
    Route::apiResource('all/projects', AllProjectController::class);
    Route::apiResource('all/project/categories', AllProjectCategoryController::class);
    Route::apiResource('photos', PhotoController::class);
    Route::apiResource('photo/folders', PhotoFolderController::class);
    Route::apiResource('regions', RegionController::class);
    Route::apiResource('data/regions', RegionDataController::class);
    Route::post("/image", [FileController::class, "uploadSingleImage"]);
    Route::post("/file", [FileController::class, "uploadFile"]);
});
