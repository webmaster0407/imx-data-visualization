<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TlvsController extends Controller
{
    /*
        @usage : display Tlvs
        @params: 
        @return: view
    */
    public function index() {

    }

    /*
        @name  : get_TLV_info
        @usage : Get TLV information for a user for a token
        @params: 
            $enterKey required : User's wallet address
            $tokenAddress required : Token address

        @return: 
            {
              "code": "not_implemented",
              "message": "Feature not yet implemented: /v1/claims/{etherKey}/{tokenAddress}"
            }
    */
    public function get_TLV_info($etherKey, $tokenAddress) {
        $response = Http::acceptJson()
        ->get(
            'https://api.ropsten.x.immutable.com/v1/claims/' . $etherKey . '/' . $tokenAddress
        );
        echo $response->getBody();
    }
}
