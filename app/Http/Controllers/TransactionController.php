<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    public function listTransactionV2(Request $request) {

        $url = 'https://3vkyshzozjep5ciwsh2fvgdxwy.appsync-api.us-west-2.amazonaws.com/graphql';

        $operation_name = "listTransactionsV2";
        
        $query = "query listTransactionsV2(\$address: String!, \$pageSize: Int, \$nextToken: String, \$txnType: String, \$maxTime: Float) {\n  listTransactionsV2(\n    address: \$address\n    limit: \$pageSize\n    nextToken: \$nextToken\n    txnType: \$txnType\n    maxTime: \$maxTime\n  ) {\n    items {\n      txn_time\n      txn_id\n      txn_type\n      transfers {\n        from_address\n        to_address\n        token {\n          type\n          quantity\n          usd_rate\n          token_address\n          token_id\n          __typename\n        }\n        __typename\n      }\n      __typename\n    }\n    nextToken\n    lastUpdated\n    txnType\n    maxTime\n    scannedCount\n    __typename\n  }\n}";
        
        $veve_address = "0xa7aefead2f25972d80516628417ac46b3f2604af";
        $pageSize = 1000;

        $variables = [
            "address" => $veve_address,
            "pageSize" => $pageSize
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

        echo "<pre>";
        print_r($response_array);
        echo "</pre>";
    }

    public function getTokenDetail(Request $request, $token_address, $token_id) {
        $url = "https://api.x.immutable.com/v1/assets/" . $token_address . "/" . $token_id;
        $response = Http::acceptJson()
            ->get(
                $url
            );
        $response_array = json_decode($response, true);

        echo "<pre>";
        print_r($response_array);
        echo "</pre>";
    }

    public function getTxn(Request $request, $txn_id) {
        $url = "https://3vkyshzozjep5ciwsh2fvgdxwy.appsync-api.us-west-2.amazonaws.com/graphql";
        $operationName = "getTransaction";
        $query = "query getTransaction(\$txn_id: Int!) {\n  getTransaction(txn_id: \$txn_id) {\n    txn_time\n    txn_id\n    txn_type\n    transfers {\n      from_address\n      to_address\n      token {\n        internal_id\n        quantity\n        token_address\n        usd_rate\n        type\n        token_id\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}";
        $variables = [
            'txn_id' => $txn_id
        ];

        $data = [
            "operationName" => $operationName,
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

        $response_array = json_decode($response, true);

        echo "<pre>";
        print_r($response_array);
        echo "</pre>";
    }
}


// 5812858          0xa7aefead2f25972d80516628417ac46b3f2604af     5882808 