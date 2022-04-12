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

    /*
        @name  : getMintableTokenDetailByIMXTokenId
        @usage : Get details of a mintable token with the given IMX token ID
        @params: 
            path params: 
                string $id required
            body params:
        @return: 
            {
                "code":"resource_not_found_code",
                "message":"Mintable Token id '68615979' not found"
            }
    */
    public function getMintableTokenDetailByIMXTokenId($id) {
        $response = Http::acceptJson()
            ->get(
                $this->base_url . '/mintable-token/' . $id
            );
        echo $response->getBody();
    }

    /*
        @name : getMintableTokenByTokenAddressAndTokenId
        @usage : Get details of a mintable token with the given token address and token ID
        @params: 
            path params: 
                string $token_address required
                string $token_id  required
            body params:
        @return: 
            {
                "token_id":"0x1d82b32d0cdaee7b06c69a22e3f98b171e5d2a53b4faf70a0c2c58adab91763d",
                "client_token_id":"5879500",
                "blueprint":"Inhumans,26541"
            }
    */
    public function getMintableTokenByTokenAddressAndTokenId($token_address, $token_id) {
        $response = Http::acceptJson()
            ->get(
                $this->base_url . '/mintable-token/' . $token_address . '/' . $token_id
            );
        echo $response->getBody();
    }

    /*
        @name : getMintsList
        @usage : Get a list of mints
        @params: 
            path params: 
                
            body params:
                integer page_size : Page size of the result
                string cursor : Cursor
                string order_by : Property to sort by
                string direction : Direction to sort (asc/desc)
                string user     : Ethereum address of the user who owns these assets
                string status   : Status of these assets
                string min_timestamp : Minimum timestamp for this mint
                string max_timestamp : Maximum timestamp for this mint
                string token_type : Token type of the minted asset
                string token_id  : ERC721 Token ID of the minted asset
                string asset_id: Internal IMX ID of the minted asset
                string token_name : Token Name of the minted asset
                string token_address : Token address of the minted asset
                string min_quantity : Min quantity for the minted asset
                string max_quantity : Max quantity for the minted asset
                string metadata : JSON-encoded metadata filters for the minted asset
        @return: 
        //
    */
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


    /*
        @name : mintTokens
        @method: post
        @usage : Mint tokens in a batch
        @params: 
            path params: 
               
            body params:
                object mints required
        @return: 
            //
    */
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


    /*
        @name : getMintDetailsById
        @usage : Get details of a mint with the given ID
        @params: 
            path params:
                string $id  required
            body params:
                
        @return: 
            //
    */
    public function getMintDetailsById($id) {
        $response = Http::acceptJson()
            ->get(
                $this->base_url . '/mints/' . $id
            );
        echo $response->getBody();
    }


    /*
        @name : mintTokensV2
        @method: post
        @usage : Mint tokens in a batch with fees
        @params: 
            path params: 
            body params:
                object 
        @return: 
            //
    */
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
