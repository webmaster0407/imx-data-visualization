<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MintsController extends Controller
{

    private $base_url = "https://api.x.immutable.com/v1";
    /*
        @usage : display mints
        @params: 
        @return: view
    */
    public function index() {

    }


    public function getMintableTokenDetailByIMXTokenId($id) {
        $response = Http::acceptJson()
            ->get(
                $this->base_url . '/mintable-token/' . $id
            );
        echo $response->getBody();
    }

    public function getMintableTokenByTokenAddressAndTokenId($token_address, $token_id) {
        $response = Http::acceptJson()
            ->get(
                $this->base_url . '/mintable-token/' . $token_address . '/' . $token_id
            );
        echo $response->getBody();
    }

    public function getMintsList(Request $request) {
        $body = [];
        if ($request->page_size !== null) {
            $body['page_size'] = $request->page_size;
        }
        if ($request->cursor !== null) {
            $body['cursor'] = $request->cursor;
        }
        if ($request->order_by !== null) {
            $body['order_by'] = $request->order_by;
        }
        if ($request->direction !== null) {
            $body['direction'] = $request->direction;
        }
        if ($request->user !== null) {
            $body['user'] = $request->user;
        }
        if ($request->status !== null) {
            $body['status'] = $request->status;
        }
        if ($request->min_timestamp !== null) {
            $body['min_timestamp'] = $request->min_timestamp;
        }
        if ($request->max_timestamp !== null) {
            $body['max_timestamp'] = $request->max_timestamp;
        }
        if ($request->token_type !== null) {
            $body['token_type'] = $request->token_type;
        }
        if ($request->token_id !== null) {
            $body['token_id'] = $request->token_id;
        }
        if ($request->asset_id !== null) {
            $body['asset_id'] = $request->asset_id;
        }
        if ($request->token_name !== null) {
            $body['token_name'] = $request->token_name;
        }
        if ($request->token_address !== null) {
            $body['token_address'] = $request->token_address;
        }
        if ($request->min_quantity !== null) {
            $body['min_quantity'] = $request->min_quantity;
        }
        if ($request->max_quantity !== null) {
            $body['max_quantity'] = $request->max_quantity;
        }
        if ($request->metadata !== null) {
            $body['metadata'] = $request->metadata;
        }
        $response = Http::acceptJson()
            ->get(
                $this->base_url . '/mints',
                $body
            );

        echo "<pre>";
        print_r(json_decode($response->getBody(), true));
        echo "</pre>";
    } 

    public function mintTokens(Request $request) {
        $body = [];
        $mints = $request->mints;
        $body['mints'] = $mints;
        $response = Http::acceptJson()
            ->post(
                $this->base_url . '/mints',
                $body
            );
        echo $response->getBody();    }


    public function getMintDetailsById($id) {
        $response = Http::acceptJson()
            ->get(
                $this->base_url . '/mints/' . $id
            );
        echo $response->getBody();
    }

    public function mintTokensV2(Request $request) {
        $body = [];
        $royalties = $request->royalties;

        $body['royalties'] = $royalties;
        $body['auth_signature'] = $request->auth_signature;
        $body['contract_address'] = $request->contract_address;

        $response = Http::acceptJson()
            ->post(
                "https://api.ropsten.x.immutable.com/v2/mints",
                $body
            );
        echo $response->getBody();
    }



}
