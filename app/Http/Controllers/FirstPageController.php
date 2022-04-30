<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Token;
use App\Models\Txn;

class FirstPageController extends Controller
{
    public function __construct() {
        ini_set('max_execution_time', 10000000);
    }

    public function index() {

    }

    public function getUniqueWalletCnt() {
        $uniqueTokens = Token::groupBy('user')->orderBy('id')->get();
        $cnt = 0
        if (isset($uniqueTokens)) {
            $cnt = sizeof($uniqueTokens);
        }

        return $cnt;
    }

    public function getMintingDropTime($f_txn_id, $l_txn_id) {
        $f_txn = Txn::where('id', '=', $f_txn_id)->first();
        $l_txn = Txn::where('id', '=', $l_txn_id)->first();

        $f_txn_time = $f_txn->txn_time;
        $l_txn_time = $l_txn->txn_time;

        $duration = ($l_txn - $f_txn) / 1000;

        $hours = $duration / 3600;
        $mins = ($duration % 3600) / 60;
        $secs = ($duration % 3600) % 60;

        $duration_timeformat = "";
        if ($hours != 0) $duration += ($hours . " Hour(s)");
        if ($mins != 0) $duration += ($mins . " Min(s)"); 
        $duration += ($secs . " Seconds");

        return $duration_timeformat;
    }

    public function getTokenHistory($token) {
        $id = $token->id;
        $url = 'https://3vkyshzozjep5ciwsh2fvgdxwy.appsync-api.us-west-2.amazonaws.com/graphql';

        $operation_name = "tokenHistory";
        
        $query = "query tokenHistory(\$token_id) (\$address: String!, \$pageSize: Int, \$nextToken: String, \$txnType: String, \$maxTime: Float) {\n  listTransactionsV2(\n    address: \$address\n    limit: \$pageSize\n    nextToken: \$nextToken\n    txnType: \$txnType\n    maxTime: \$maxTime\n  ) {\n    items {\n      txn_time\n      txn_id\n      txn_type\n      transfers {\n        from_address\n        to_address\n        token {\n          type\n          quantity\n          usd_rate\n          token_address\n          token_id\n          __typename\n        }\n        __typename\n      }\n      __typename\n    }\n    nextToken\n    lastUpdated\n    txnType\n    maxTime\n    scannedCount\n    __typename\n  }\n}";
        
        $veve_address = "0xa7aefead2f25972d80516628417ac46b3f2604af";
        $pageSize = 50000;

        $variables = [
            "address" => $veve_address,
            "pageSize" => $pageSize,
            "txnType" => "mint"
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

    public function getSuccessfulWallet($f_txn_id, $l_txn_id, $timestampbefore) {
        

        $tokens = Token::where('created_at', '>=', date('yyyy-MM-dd', $timestampbefore));

        $cnt = 0;
        foreach ( $tokens as $token ) {
            $f_txn = Txn::where('id', '=', $f_txn_id)->first();
            $l_txn = Txn::where('id', '=', $l_txn_id)->first();


            $f_txn_time = $f_txn->txn_time;
            $l_txn_time = $l_txn->txn_time;

            $tokenHistory = $this->getTokenHistory($token, $f_txn_time, $l_txn_time);

            if ($tokenHistory === null) {
                if ($tokenHistory->next->now == "mint" ) {
                    $cnt++;    
                }
            }
        }

        return $cnt;
    }

    public function standardiseMintsTime($f_txn_id, $l_txn_id) {
        $f_txn = Txn::where('id', '=', $f_txn_id)->first();
        $l_txn = Txn::where('id', '=', $l_txn_id)->first();

        $f_txn_time = $f_txn->txn_time;
        $l_txn_time = $l_txn->txn_time;

        $mins = ($l_txn - $f_txn) / 1000 / 60;

        $rlt = ($l_txn_id - $f_txn_id) / $secs;

        return $rlt;
    }

    
}
