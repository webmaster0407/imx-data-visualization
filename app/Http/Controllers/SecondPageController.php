<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Token;
use App\Models\Txn;
use App\Models\Wallet;

class SecondPageController extends Controller
{
    public function __construct() {
        ini_set('max_execution_time', 10000000);
    }

    public function index() {

    }

    public function getSeasonWalletDistribution(Request $request) {
        $season_id = $request->season_id;
        $wallets = Wallet::where('season_id', '=', $season_id)
            ->where('nft_cnt', '>', 0)
            ->get();

        echo $wallets;
    }

    public function getWalletDistribution(Request $request) {
        $wallets = Wallet::where('nft_cnt', '>', 0)->get();
        echo $wallets;
    }

    public function getWalletsAgainstTime(Request $request) {
        $time = $request->time;
        $wallets = Wallet::where('created_at', '<', $time)->get();
        echo $wallets;
    }

    public function getHodlWallets(Request $request) {
        $season_id = $request->season_id;
        $wallets = Wallets::where('season_id', '=', $season_id)->get();

        $hodl_wallets = [];

        foreach($wallets as $wallet) {
            $wallet_history = $this->getWalletHistory($wallet);

            $history = $wallet_history->data->listTrasactionsV2->items;
            $cnt = sizeof($history);
            $toCnt = 0;
            for ($i = 0; $i < $cnt; $i++) {
                if ($history[$i]->trasfer->to_address === null) {
                    $toCnt ++;
                }
            }
            if ($toCnt / $cnt < 0.5) {
                $hodl_wallets[] = [
                    'address' => $wallet,
                    'percent' => $toCnt / $cnt
                ];
            }
        }

        echo json_encode($hodl_wallets);
    }

    public function getWalletHistory($wallet_address) {
        $url = 'https://3vkyshzozjep5ciwsh2fvgdxwy.appsync-api.us-west-2.amazonaws.com/graphql';

        $operation_name = "getWalletCollections";
        
        $query = "query getWalletCollections(\$address: String!) {\n  getWalletCollections(address: \$address) {\n    items {\n      collection_address\n      token_count\n      __typename\n    }\n    nextToken\n    __typename\n  }\n}";

        $pageSize = 50000;

        $variables = [
            "address" => $wallet_address,
            "pageSize" => $pageSize,
        ];

        $data = [
            "operationName" => $operation_name,
            "query" => $query,
            "variables" => $variables
        ];

        $response = Http::acceptJson()
            ->withHeaders([
                'x-api-key'=> 'da2-ihd6lsinwbdb3e6c6ocfkab2nm'
            ])->post(
                $url,
                $data
            );

        $response_array = json_decode($response->getBody(), true);
    }
}
