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
use App\Http\Controllers\TransactionController;
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
| TestController Routes
|--------------------------------------------------------------------------
*/

Route::get('_test', [TestController::class, '_getTest']);


/*
|--------------------------------------------------------------------------
| ApplicationController Routes
|--------------------------------------------------------------------------
*/
Route::get('_applications', [ApplicationController::class, '_getApplications']);
Route::get('_applications/{id}', [ApplicationController::class, '_getApplicationDetail']);

/*
|--------------------------------------------------------------------------
| AssetController Routes
|--------------------------------------------------------------------------
*/
Route::get('_assets', [AssetController::class, '_getAssets']);
Route::get('_assets/{token_address}/{token_id}', [AssetController::class, '_getAssetDetail']);


/*
|--------------------------------------------------------------------------
| BalancesController Routes
|--------------------------------------------------------------------------
*/
Route::get('_fetch_WEI_balances/{owner}', [BalancesController::class, '_fetch_WEI_balances']);
Route::get('_get_balances_list/{owner}', [BalancesController::class, '_get_balances_list']);
Route::get('_fetch_token_balances/{owner}/{address}', [BalancesController::class, '_fetch_token_balances']);

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
Route::get('_getCollections', [CollectionsController::class, '_getCollections']);
Route::post('_createCollection', [CollectionsController::class, '_createCollection']);
Route::get('_getCollection/{address}', [CollectionsController::class, '_getCollection']);
Route::post('_updateCollection/{address}', [CollectionsController::class, '_updateCollection']);
Route::get('_get_list_collection_filters/{address}/filters', [CollectionsController::class, '_get_list_collection_filters']);
Route::get('_get_collection_metadataSchema/{address}/metadata-schema', [CollectionsController::class, '_get_collection_metadataSchema']);
Route::post('_add_metadataSchema_to_collection/{address}/metadata-schema', [CollectionsController::class, '_add_metadataSchema_to_collection']);
Route::post('_update_metadataSchema_by_name/{address}/metadata-schema/{schemaName}', [CollectionsController::class, '_update_metadataSchema_by_name']);



/*
|--------------------------------------------------------------------------
| DepositsController Routes
|--------------------------------------------------------------------------
*/
Route::get('_getDeposits', [DepositsController::class, '_getDeposits']);
Route::get('_getDeposit/{id}', [DepositsController::class, '_getDeposit']);
Route::post('_get_signable_deposit_details', [DepositsController::class, '_get_signable_deposit_details']);




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

Route::get('_getMTDByIMXTokenId/{id}', [MintsController::class, '_getMintableTokenDetailByIMXTokenId']); 
Route::get('_getMTByTAddressAndTId/{token_address}/{token_id}', [MintsController::class, '_getMintableTokenByTokenAddressAndTokenId']);
Route::get('_getMintsList', [MintsController::class, '_getMintsList']); 
Route::post('_mintTokens', [MintsController::class, '_mintTokens']);
Route::get('_getMintDetailsById/{id}', [MintsController::class, '_getMintDetailsById']);
Route::post('_mintTokensV2', [MintsController::class, '_mintTokensV2']);


/*
|--------------------------------------------------------------------------
| OrdersController Routes
|--------------------------------------------------------------------------
*/

// Route::get('mintTokensV2', [OrdersController::class, 'mintTokensV2']);

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
Route::get('_get_TLV_info/{etherKey}/{tokenAddress}', [TlvsController::class, '_get_TLV_info']);

/*
|--------------------------------------------------------------------------
| TokensController Routes
|--------------------------------------------------------------------------
*/
Route::get('_getTokens', [TokensController::class, '_getTokens']);
Route::get('_getTokenDetail/{token_address}/{token_id}', [TokensController::class, '_getTokenDetail']);


Route::get('storeToken', [TokensController::class, 'storeToken']);

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


/*
|--------------------------------------------------------------------------
| TransactionController Routes
|--------------------------------------------------------------------------
*/

Route::get('_listTransactionV2', [TransactionController::class, '_listTransactionV2']);
// Route::get('getTokenDetail/{token_address}/{token_id}', [TransactionController::class, 'getTokenDetail']);
Route::get('_getTxn/{txn_id}', [TransactionController::class, '_getTxn']);

