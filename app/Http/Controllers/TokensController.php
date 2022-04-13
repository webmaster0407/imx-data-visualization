<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TokensController extends Controller
{
    
    private $base_url = "https://api.x.immutable.com/v1";
    
    /*
        @usage : display mints
        @params: 
        @return: view
    */
    public function index() {

    }

    public function getTokens() {
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

    public function getTokenDetail($token_address, $token_id) {
        $body = [];
        $body['address'] = $address;
    
        $response = Http::acceptJson()
            ->post(
                $this->base_url . '/assets/' . $token_address . '/' . $token_id,
                $body
            );
        echo json_encode($response->getBody());    
    }

    // /** old API using
    // /*
    //     @name : getTokens
    //     @usage : Get a list of tokens
    //     @params: 
    //         path params: 
               
    //         body params:
    //             string address : Contract address of the token
    //             string symbols : Token symbols for the token, e.g. ?symbols=IMX,ETH
    //     @return: 
    //         //
    // */
    // public function getTokens(Request $request) {
    //     $body = [];
    //     if ($request->address !== null) {
    //         $body['address'] = $request->address;
    //     }
    //     if ($request->symbols !== null) {
    //         $body['symbols'] = $request->symbols;
    //     }
    //     $response = Http::acceptJson()
    //         ->post(
    //             $this->base_url . '/tokens',
    //             $body
    //         );
    //     echo $response->getBody();    
    // }

    // /*
    //     @name : getTokenDetailByAddress
    //     @usage : Get details of an token
    //     @params: 
    //         path params: 
    //             string $address required
    //         body params:
    //     @return: 
    //         //
    // */
    // public function getTokenDetailByAddress($address) {
    //     $body = [];
    //     $body['address'] = $address;
    
    //     $response = Http::acceptJson()
    //         ->post(
    //             $this->base_url . '/tokens/' . $address,
    //             $body
    //         );
    //     echo json_encode($response->getBody());    
    // }

    // */
}
