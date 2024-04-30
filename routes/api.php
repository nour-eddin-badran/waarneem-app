<?php

use App\Http\Controllers\Api\V1\Importer\ImportController;
use App\Http\Controllers\Api\V1\Companies\CompanyController;
use App\Http\Controllers\Api\V1\Users\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix'=> 'v1'], function () {
    Route::post('import', [ImportController::class, 'store']);
    Route::resource('companies', CompanyController::class)->only(['index', 'store']);
    Route::resource('users', UserController::class)->only(['store']);
});
