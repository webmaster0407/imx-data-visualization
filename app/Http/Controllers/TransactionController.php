<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{

    /*
        @name  : listTransactionV2
        @usage : list transactions
        @params: 
            path params: 
                
            body params:
                string $operation_name : organize name 
                string $query   : graphql query 
                string $address : veve_address
                int $pageSize : transactions per page
        @return: 
            Array(
                [data] => Array(
                        [listTransactionsV2] => Array(
                                [items] => Array(
                                        [0] => Array(
                                                [txn_time] => 1649731710774
                                                [txn_id] => 68615637
                                                [txn_type] => transfer
                                                [transfers] => Array(
                                                        [0] => Array(
                                                                [from_address] => 0xee710d72de860ef7c44857ec5de84023923f9ca9
                                                                [to_address] => 0x23a433a24cf23f061514e20839ff82d26635adc2
                                                                [token] => Array(
                                                                        [type] => ERC721
                                                                        [quantity] => 1
                                                                        [usd_rate] => 
                                                                        [token_address] => 0xa7aefead2f25972d80516628417ac46b3f2604af
                                                                        [token_id] => 5270094
                                                                        [__typename] => Token
                                                                    )
                                                                [__typename] => Transfer
                                                            )
                                                    )
                                                [__typename] => Transaction
                                            )
                                        [1] => Array(
                                                [txn_time] => 1649731710771
                                                [txn_id] => 68615636
                                                [txn_type] => transfer
                                                [transfers] => Array(
                                                        [0] => Array(
                                                                [from_address] => 0x7d7c4b3da277eb7cd14619907b47fc0958673e8b
                                                                [to_address] => 0x68c2b8b242b78d9100c574a59c537ab50f57b448
                                                                [token] => Array(
                                                                        [type] => ERC721
                                                                        [quantity] => 1
                                                                        [usd_rate] => 
                                                                        [token_address] => 0xa7aefead2f25972d80516628417ac46b3f2604af
                                                                        [token_id] => 4729995
                                                                        [__typename] => Token
                                                                    )
                                                                [__typename] => Transfer
                                                            )
                                                    )
                                                [__typename] => Transaction
                                            )
                                    )
                                [nextToken] => eyJ2ZXJzaW9uIjoyLCJ0b2tlbiI6IkFRSUNBSGkrT2loUXVpRWFIT0Z5TUMwK3VKSzMvK0F1Y0hzR2NIdFljYlA4YytlNy9nSGk2QnJtRk1ZVTNaN0Z6ZDVZQWRyK0FBQUN0VENDQXJFR0NTcUdTSWIzRFFFSEJxQ0NBcUl3Z2dLZUFnRUFNSUlDbHdZSktvWklodmNOQVFjQk1CNEdDV0NHU0FGbEF3UUJMakFSQkF4R3o2dnBGa3RXTGVIL1cxd0NBUkNBZ2dKbzBTU08xZCt1WlN6b1NkZmRuMndvaFZrYTE3cW04bWx5QjhQL0ZUYm1kaWpuK2V2TFZpTUZhVHpVY3FrSHhlQ0Q0Vkg1MHJXTmt6RVF6WWZzUS95TllvZUNIVXlnR05Db1lnd05yRlg1bWFqSmgwMlRCalpTWXl2K3prLzAxK004QjFYZFNHQ25EY0RMVjNranJ6NGRmbVFHMURQOUxIK041MUxPOVB0aVd1WjJ6VkJsZEU0Q3FGT09CQzhpMHlpS1dMemI3S0UzUUR6enhVazlJdFppMTNMQkRHc1IrMnBHeEF6eUJtU2lkd21ybDJEeE5Tclc0RC8yOXlPRmlhUkN6ZUVxV3Qxd2M0bTNHRk52SEJ0WWtCdlRYUGFnTFNqL3hsTytZbGJzbm4ra2o3eDlaczhGek12N2E1OGZmZW9tUVZTV0ZUcWgyeWxTVWtGeVpIWEVmUDdlUHRtQzU2KzgyVWNwWXFtN2c4WGptTHk1Y21ZdVErUkQybDh6emx3N0F4V0ZBamdraUdydXBHZGxoV3ZyY0F1ZWRPU1FMMXJZRXFYTmdFdVV3T3lDUDc1S2h3aUpzQlh1a1BKNm91dXh0M2dSSWQwR0JoQjV4elQ4ZVRFNlFPYWRLaTFZVlJLTDJKeVR6RGJlYXlvUGxXS080KzQ1Q1h1SEl0YStIaFk2OHh2S1NLelRkdlFCbVhNVWE5SnBQQUhCYkJHcGtEUzJWZE1qS3FFWkVzWE82eXZiZXMwYWV4aE4xdTZtQlgrNnJndTBlVUlPMTh1eUZBNjdzcHM1TE9DQWtDbDBSbDAwYTd6TXBqd0xnenZkanA4alFVMXArYnRyQjFQVVY5SjNTMlAzMW5XRG81Z1dQUVVra0RTWC80WFMwOFRWaENJSXVEVjhERDY5YkdIQ2lFMG1RNVYrd2pENjRnd05FbVZ2ZVpQdmdxT1c2cjNESy82cy9zZ1FHdjZibTFldldGWWRuVmNTSDVjUzF3QlRhdVNqZ2VQWFNkZ0JEclhka2VnSy9iQi8xRjNxQzhjdXZicUlHM2x3emtvSkxNelduTnVDc1JnRUF1c0dTSHJ3MWhQQUVPNnhOdz09In0=
                                [lastUpdated] => 
                                [txnType] => 
                                [maxTime] => 
                                [scannedCount] => 2
                                [__typename] => TransactionConnection
                            )
                    )
            )
    */
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

    /*
        @name  : getTokenDetail
        @usage : Get token detail
        @params: 
            path params: 
                string $token_address
                string $token_id
            body params: 
        @return: 
            Array(
                [token_address] => 0xa7aefead2f25972d80516628417ac46b3f2604af
                [token_id] => 5270094
                [id] => 0x4565344f461269f6b692e52cf9ab1123af9ad100b2bbdb63030031282f7328ee
                [user] => 0x23a433a24cf23f061514e20839ff82d26635adc2
                [status] => imx
                [uri] => 
                [name] => 
                [description] => 
                [image_url] => 
                [metadata] => Array()

                [collection] => Array(
                        [name] => VEVE
                        [icon_url] => 
                    )
                [created_at] => 2022-03-11T16:32:41.680469Z
                [updated_at] => 2022-04-12T02:48:30.774804Z
            )
    */
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


    /*
        @name  : getTxn
        @usage : Get transaction detail from txn_id
        @params: 
            path params: 
                string $txn_id
            body params: 
        @return: 
            Array(
                [data] => Array(
                        [getTransaction] => Array(
                                [txn_time] => 1649732011396
                                [txn_id] => 68615979
                                [txn_type] => transfer
                                [transfers] => Array(
                                        [0] => Array(
                                                [from_address] => 0x0313e780eb7af3f72043c01a1f6c7e9998cdef7c
                                                [to_address] => 0xbb23d2804869fd37a2817bdd77c65aaa3061d082
                                                [token] => Array(
                                                        [internal_id] => 0x1d82b32d0cdaee7b06c69a22e3f98b171e5d2a53b4faf70a0c2c58adab91763d
                                                        [quantity] => 1
                                                        [token_address] => 0xa7aefead2f25972d80516628417ac46b3f2604af
                                                        [usd_rate] => 
                                                        [type] => ERC721
                                                        [token_id] => 5879500
                                                        [__typename] => Token
                                                    )
                                                [__typename] => Transfer
                                            )
                                    )
                                [__typename] => Transaction
                            )
                    )
            )
    */
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
