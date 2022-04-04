<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class BalancesController extends Controller
{

    /*
        @usage : display Balances
        @params: 
        @return: view
    */
    public function index() {

    }


    /*
        @name  : fetch_WEI_balances
        @usage : Fetches the WEI balances of the user
        @params: 
            $owner : address of the owner/user 
        @return: 
            {
              "imx": "0",
              "preparing_withdrawal": "0",
              "withdrawable": "0"
            }
    */
    public function fetch_WEI_balances($owner) {
        $response = Http::acceptJson()
        ->get(
            'https://api.ropsten.x.immutable.com/v1/balances/' . $owner
        );
        echo $response->getBody();
    }


    /*
        @name  : get_balances_list
        @usage : Get a list of balances for given user
        @params: 
            $owner : ethereum wallet address for user
        @return: 
            {
              "result": [
                {
                  "symbol": "ETH",
                  "balance": "0",
                  "preparing_withdrawal": "0",
                  "withdrawable": "0"
                }
              ],
              "cursor": "eyJfIjoiIiwic3ltYm9sIjoiRVRIIiwiY29udHJhY3RfYWRkcmVzcyI6IiIsImlteCI6IjAiLCJwcmVwYXJpbmdfd2l0aGRyYXdhbCI6IjAiLCJ3aXRoZHJhd2FibGUiOiIwIn0"
            }
    */
    public function get_balances_list($owner) {
        $response = Http::acceptJson()
        ->get(
            'https://api.ropsten.x.immutable.com/v2/balances/' . $owner
        );
        echo $response->getBody();
    }

    /*
        @name  : fetch_token_balances
        @usage : Fetches the token balances of the user
        @params: 
            $owner  rquired: address of the owner/user
            $address rquired: token address
        @return: 

    */
    public function fetch_token_balances($owner, $address) {
        $response = Http::acceptJson()
        ->get(
            'https://api.ropsten.x.immutable.com/v2/balances/' . $owner . '/' . $address
        );
        echo $response->getBody();
    }
}
