<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Token;
use App\Models\Txn;
use App\Models\Wallet;

class MarketPageController extends Controller
{
    public function __construct() {
        ini_set('max_execution_time', 10000000);
    }

    public function index() {

    }

    public function getTrasactionRates(Request $request) {
        $season_id = $request->season_id;
        $total_txns = Txn::where('season_id', '=', $season_id)
            ->where('type', '=', "transfer")
            ->get();
        $total_txns_cnt = ($total_txns === null) ? 0 : sizeof($total_txns);
        
        $first_txn_in_season = Txn::where('season_id', '='. $season_id)->orderBy('txn_time', 'ASC')->first();
        $last_txn_in_season = Txn::where('season_id', '='. $season_id)->orderBy('txn_time', 'DESC')->first();
        // calculate the time with the unit "hour"
        $duration = time(strtotime($last_txn_in_season) - strtotime($first_txn_in_season)) / 1000 / 3600;  

        $txn_rate = $total_txns_cnt / $duration;
        echo $duration;
    }

    public function getTradeRate() {

        $tokens = Token::get();
        if ($tokens === null) {
            $data = [
                'msg' => 'failed',
                'data' => null
            ];
            echo json_encode($data);
            return;
        } 

        $tradeRates = [];
        $url = 'https://3vkyshzozjep5ciwsh2fvgdxwy.appsync-api.us-west-2.amazonaws.com/graphql';
        $operation_name = "getMetrics";
        $query = "query getMetrics(\$address: String!) {\n  getMetrics(address: \$address, type: \"total\") {\n    trade_count\n    owner_count\n    transaction_count\n    trade_proceeds_usd\n    trade_proceeds_eth\n    trade_spend_usd\n    trade_spend_eth\n    trade_volume_usd\n    trade_volume_eth\n    mint_token_count\n    floor_price_usd\n    floor_price_eth\n    __typename\n  }\n}";
        $veve_address = "0xa7aefead2f25972d80516628417ac46b3f2604af";
        $pageSize = 5000;

        foreach($tokens as $token) {
            $variables = [
                "address" => $veve_address . '/' . $token->address,
                "pageSize" => $pageSize,
            ];
            $data = [
                "operationName" => $operation_name,
                "query" => $query,
                "variables" => $variables
            ];

            $tokenHistory = Http::acceptJson()
                ->withHeaders([
                    'x-api-key'=> 'da2-ihd6lsinwbdb3e6c6ocfkab2nm'
                ])->post(
                    $url,
                    $data
                );

            $tokenHistory = json_decode($tokenHistory->getBody(), true);

            ///////////////////////////

            $tokenTrasactionHistory = ($tokenHistory === null) ? null : (($tokenHistory->listTrasactionsV2 === null) 
                            ? null 
                            : (
                                ($tokenHistory->listTrasactionsV2->items === null) 
                                    ? null 
                                    : $tokenHistory->listTrasactionsV2->items
                            ));

            if ($tokenTrasactionHistory === null) {
                continue;
            }

            $cnt = 0;
            foreach($tokenTrasactionHistory as $txn) {
                if ($txn->txn_type == "transfer") {
                    $cnt++;
                }
            }

            if ($cnt == 0) {
                continue;
            }

            $tradeRates[] = [
                'token_id' => $token->token_id,
                'tradeRate' => $cnt / (($tokenHistory[sizeof($tokenHistory) - 1]['txn_time'] -$tokenHistory[0]['txn_time'] ) / 1000 / 3600)
            ];
        }

        if (sizeof($tradeRates) == 0) {
            $data = [
                'msg' => 'failed',
                'data' => null
            ];
        }

        $data = [
            'msg' => 'success',
            'data' => $tradeRates
        ];

        echo json_encode($data);
        return;
    }

    public function tradeSort($trade1, $trade2) {
        if ($trade1->tradeRate > $trade2->tradeRate) {
            return 1;
        } else if ($trade1->tradeRate == $trade2->tradeRate) {
            return 0;
        } else {
            return -1;
        }
    }

    public function getMostTransferedNFTs(Request $request) {
        $tradeHistory = $this->getTradeRate();
        $tradeHistory = json_decode($tradeHistory, true);
        if ($tradeHistory->msg == 'failed') {
            echo null;
            return;
        }

        $tradeRates = $tradeHistory->data;

        usort($this->tradeSort, $tradeRates);

        echo $tradeRates;
        return;
    }
}
