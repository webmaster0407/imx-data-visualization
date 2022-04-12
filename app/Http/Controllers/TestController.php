<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller {
    public function getTest() {
        $response = Http::acceptJson()
        ->withHeaders([
            'x-api-key'=> '0xa7aefead2f25972d80516628417ac46b3f2604af'
        ])->get(
            'api.ropsten.x.immutable.com/v1/applications'
        );
        echo $response->getBody();
    }
}


/** queries

operationName: "listTransactionsV2"
    query: "query listTransactionsV2(\$address: String!, \$pageSize: Int, \$nextToken: String, \$txnType: String, \$maxTime: Float) {\n  listTransactionsV2(\n    address: \$address\n    limit: \$pageSize\n    nextToken: \$nextToken\n    txnType: \$txnType\n    maxTime: \$maxTime\n  ) {\n    items {\n      txn_time\n      txn_id\n      txn_type\n      transfers {\n        from_address\n        to_address\n        token {\n          type\n          quantity\n          usd_rate\n          token_address\n          token_id\n          __typename\n        }\n        __typename\n      }\n      __typename\n    }\n    nextToken\n    lastUpdated\n    txnType\n    maxTime\n    scannedCount\n    __typename\n  }\n}"

operationName: "getMetrics"
    query: "query getMetrics(\$address: String!) {\n  getMetrics(address: \$address, type: \"total\") {\n    trade_count\n    owner_count\n    transaction_count\n    trade_proceeds_usd\n    trade_proceeds_eth\n    trade_spend_usd\n    trade_spend_eth\n    trade_volume_usd\n    trade_volume_eth\n    mint_token_count\n    floor_price_usd\n    floor_price_eth\n    __typename\n  }\n}"

operationName: "getTransaction"
    query: "query getTransaction(\$txn_id: Int!) {\n  getTransaction(txn_id: \$txn_id) {\n    txn_time\n    txn_id\n    txn_type\n    transfers {\n      from_address\n      to_address\n      token {\n        internal_id\n        quantity\n        token_address\n        usd_rate\n        type\n        token_id\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}"


operationName: "getTransaction"
    query: "query getTransaction(\$txn_id: Int!) {\n  getTransaction(txn_id: \$txn_id) {\n    txn_time\n    txn_id\n    txn_type\n    transfers {\n      from_address\n      to_address\n      token {\n        internal_id\n        quantity\n        token_address\n        usd_rate\n        type\n        token_id\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}"

*/
