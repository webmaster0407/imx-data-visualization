<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TestController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AssetController;
// use App\Http\Controllers\TestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Welcome Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| ApplicationController Routes
|--------------------------------------------------------------------------
*/
Route::get('applications', [ApplicationController::class, 'getApplications']);
Route::get('applications/{id}', [ApplicationController::class, 'getApplicationDetail']);

/*
|--------------------------------------------------------------------------
| AssetController Routes
|--------------------------------------------------------------------------
*/
Route::get('assets', [AssetController::class, 'getAssets']);
Route::get('assets/{token_address}/{token_id}', [AssetController::class, 'getAssetDetail']);