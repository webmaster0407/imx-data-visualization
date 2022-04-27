<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Token;
use App\Models\Txn;

class TokensController extends Controller
{

    public function __construct() {
        ini_set('max_execution_time', 10000000);
    }
    
    private $base_url = "https://api.x.immutable.com/v1";
    
    /*
        @usage : display mints
        @params: 
        @return: view
    */
    public function index() {

    }

    // public function _getTokens() {
    //     $url = 'https://3vkyshzozjep5ciwsh2fvgdxwy.appsync-api.us-west-2.amazonaws.com/graphql';

    //     $operation_name = "listTransactionsV2";
        
    //     $query = "query listTransactionsV2(\$address: String!, \$pageSize: Int, \$nextToken: String, \$txnType: String, \$maxTime: Float) {\n  listTransactionsV2(\n    address: \$address\n    limit: \$pageSize\n    nextToken: \$nextToken\n    txnType: \$txnType\n    maxTime: \$maxTime\n  ) {\n    items {\n      txn_time\n      txn_id\n      txn_type\n      transfers {\n        from_address\n        to_address\n        token {\n          type\n          quantity\n          usd_rate\n          token_address\n          token_id\n          __typename\n        }\n        __typename\n      }\n      __typename\n    }\n    nextToken\n    lastUpdated\n    txnType\n    maxTime\n    scannedCount\n    __typename\n  }\n}";
        
    //     $veve_address = "0xa7aefead2f25972d80516628417ac46b3f2604af";
    //     $pageSize = 1000;

    //     $variables = [
    //         "address" => $veve_address,
    //         "pageSize" => $pageSize
    //     ];

    //     $data = [
    //         "operationName" => $operation_name,
    //         "query" => $query,
    //         "variables" => $variables
    //     ];

    //     $response = Http::acceptJson()
    //         ->withHeaders([
    //             'x-api-key'=> 'da2-ihd6lsinwbdb3e6c6ocfkab2nm'
    //         ])->post(
    //             $url,
    //             $data
    //         );

    //     $response_array = json_decode($response->getBody(), true);

    //     echo "<pre>";
    //     print_r($response_array);
    //     echo "</pre>";
    // }

    public function _getTokens() {
        $response = Http::acceptJson()
            ->get(
                $this->base_url . '/tokens'
            );
        echo "<pre>";
        print_r(json_decode($response->getBody(), true));
        echo "</pre>";
    }


    public function _getTokenDetail($token_address, $token_id) {
        $url = "https://api.x.immutable.com/v1/assets/" . $token_address . "/" . $token_id;
        $response = Http::acceptJson()
            ->get(
                $url
            );
        $response_array = json_decode($response, true);

        return $response_array;
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

    public function getLastTokenId() {
        $token = Token::orderBy('id','desc')->first();
        if ($token === null ) return 0;
        return $token['id'];
    }
    
    public function storeToken() {
        // get real last token id from fetching API
        $real_last_token_id =  200000;
        // get last token id in db
        $db_last_token_id = $this->getLastTokenId();

        $token_address = "0xa7aefead2f25972d80516628417ac46b3f2604af";  // veve token address

        // fetch token from API
        $i = $db_last_token_id + 1;
        for ( ; $i <= $real_last_token_id; $i++) {
            $token = $this->_getTokenDetail($token_address, $i);

            echo "<pre>";
            print_r($token);
            echo "</pre>";

            $tokenModel = new Token;
            $tokenModel->token_address = isset($token['token_address']) ? $token['token_address'] : null;
            $tokenModel->real_id = isset($token['id']) ? $token['id'] : null;
            $tokenModel->user = isset($token['user']) ? $token['user'] : null;
            $tokenModel->status = isset($token['status']) ? $token['status'] : null;
            $tokenModel->uri = isset($token['uri']) ? $token['uri'] : null;
            $tokenModel->name = isset($token['name']) ? $token['name'] : null;
            $tokenModel->description = isset($token['description']) ? $token['description'] : null;
            $tokenModel->image_url = isset($token['image_url']) ? $token['image_url'] : null;
            $tokenModel->metadata = isset($token['metadata']) ? $token['metadata'] : null;
            $tokenModel->collection = array(
                'name' => isset($token['collection']) ? ( isset($token['collection']['name']) ? $token['collection']['name'] : null ) : null,
                'icon_url' => isset($token['collection']) ? ( isset($token['collection']['icon_url']) ? $token['collection']['icon_url'] : null ) : null,
            );
            $tokenModel->created_at = isset($token['created_at']) ? strtotime($token['created_at'] ) : null;
            $tokenModel->updated_at = isset($token['updated_at']) ? strtotime($token['updated_at'] ) : null;
            $tokenModel->save();
        }
    }

    public function storeAsCSV() {
        $fileName = public_path() . '\storage\immuta-x-3600000.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('id', 'token_address', 'real_id', 'user', 'status', 'uri', 'name', 'description', 'image_url', 'metadata', 'collection', 'created_at', 'updated_at');

        $token_address = "0xa7aefead2f25972d80516628417ac46b3f2604af";
        
        $i = 3600000;
        $file = fopen($fileName, 'w');
        
        fputcsv($file, $columns);

        $cnt = 0;
        for ( ; $i <= 6000000 ; $i++) {
            $token = $this->_getTokenDetail($token_address, $i);

            $row = array(
                $i,
                isset($token['token_address']) ? $token['token_address'] : null,
                isset($token['id']) ? $token['id'] : null,
                isset($token['user']) ? $token['user'] : null,
                isset($token['status']) ? $token['status'] : null,
                isset($token['uri']) ? $token['uri'] : null,
                isset($token['name']) ? $token['name'] : null,
                isset($token['description']) ? $token['description'] : null,
                isset($token['image_url']) ? $token['image_url'] : null,
                isset($token['metadata']) ? implode(' ', $token['metadata']) : null,
                json_encode(array(
                            'name' => isset($token['collection']) ? ( isset($token['collection']['name']) ? $token['collection']['name'] : null ) : null,
                            'icon_url' => isset($token['collection']) ? ( isset($token['collection']['icon_url']) ? $token['collection']['icon_url'] : null ) : null,
                        )),
                isset($token['created_at']) ? $token['created_at'] : null,
                isset($token['updated_at']) ? $token['updated_at'] : null
            );

            fputcsv($file, $row);

            echo $i . '<br />';
            $cnt++;
            if ($cnt == 5000) break;
        }
        fclose($file);
    }
}
