<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TestController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\BalancesController;
use App\Http\Controllers\ClaimsController;
use App\Http\Controllers\CollectionsController;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\MintsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SnapshotController;
use App\Http\Controllers\TlvsController;
use App\Http\Controllers\TokensController;
use App\Http\Controllers\TradesController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WithdrawalsController;
// use App\Http\Controllers\TestController;
// use App\Http\Controllers\TestController;
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


/*
|--------------------------------------------------------------------------
| BalancesController Routes
|--------------------------------------------------------------------------
*/
Route::get('fetch_WEI_balances/{owner}', [BalancesController::class, 'fetch_WEI_balances']);
Route::get('get_balances_list/{owner}', [BalancesController::class, 'get_balances_list']);
Route::get('fetch_token_balances/{owner}/{address}', [BalancesController::class, 'fetch_token_balances']);

/*
|--------------------------------------------------------------------------
| ClaimsController Routes
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| CollectionsController Routes
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| DepositsController Routes
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| MetadataController Routes
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| MintsController Routes
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| OrdersController Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| ProjectsController Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| SnapshotController Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| TlvsController Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| TokensController Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| TradesController Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| TransferController Routes
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| UsersController Routes
|--------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| WithdrawlsController Routes
|--------------------------------------------------------------------------
*/



