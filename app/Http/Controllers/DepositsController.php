<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositsController extends Controller
{
    /*
        @usage : display Deposits
        @params: 
        @return: view
    */
    public function index() {

    }


    /*
        @name  : getDeposits
        @usage : Get a list of deposits
        @params: 
            body params: 
                integer  page_size  :  Page size of the result
                string  cursor : Cursor
                string  order_by : Property to sort by
                string  direction : Direction to sort(asc/desc)
                string  user : Ethereum address of the user who submitted this deposit
                string  status : Status of this deposit
                string  min_timestamp : Minimum timestamp for this deposit
                string  max_timestamp : Maximum timestamp for this deposit
                string  token_type : Token type of the deposited asset
                string  token_id : ERC721 Token ID of the minted asset
                string  asset_id : Internal IMX ID of the minted asset
                string  token_address : Token address of the deposited asset
                string  token_name : Token name of the deposited asset
                string  min_quantity : Min quantity for the deposited asset
                string  max_quantity : Max quantity for the deposited asset
                string  metadata : JSON-encoded metadata filters for the deposited asset
        @return: 
            {
              "result": [
                    {
                      "transaction_id": 4029430,
                      "status": "success",
                      "user": "0x51006580de21d31db289be8dc7c9f69355dd3a8e",
                      "token": {
                        "type": "ETH",
                        "data": {
                          "token_id": "",
                          "id": "",
                          "token_address": "",
                          "decimals": 18,
                          "quantity": "1200000000000000000"
                        }
                      },
                      "timestamp": "2022-04-04T15:37:17.307072Z"
                    },
                    ...
              ],
              "cursor": "eyJ0cmFuc2FjdGlvbl9pZCI6NDAwMDQzOCwic3RhdHVzIjoic3VjY2VzcyIsImV0aGVyX2tleSI6IjB4Njk0NDM0ZWM4NGI3YThhZDhlZmM1NzMyN2RkZDBhNDI4ZTIzZjhkNSIsIlR5cGUiOiJFVEgiLCJJRCI6IiIsIkVSQzcyMVRva2VuSUQiOiIiLCJDb250cmFjdEFkZHJlc3MiOiIiLCJEZWNpbWFscyI6MTgsIlF1YW50aXR5IjoiMTAwMDAwMDAwMDAwMDAwMDAiLCJjcmVhdGVkX2F0IjoiMjAyMi0wMy0yOVQwMzo0ODowNC4wNTgxNFoifQ",
              "remaining": 1
            }
    */
    public function _getDeposits(Request $request) {
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
        if ($request->token_address !== null) {
            $body['token_address'] = $request->token_address;
        }
        if ($request->token_name !== null) {
            $body['token_name'] = $request->token_name;
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
                'https://api.ropsten.x.immutable.com/v1/deposits',
                $body
            );
        echo $response->getBody();
    }


    /*
        @name  : getDeposit
        @usage : Get details of a deposit with the given ID
        @params: 
            path params: 
                $id  required: Deposit ID
        @return: 
            {
              "transaction_id": 4029396,
              "status": "success",
              "user": "0x23e88abffd2fc8e8a827887effe724d9335a97f3",
              "token": {
                "type": "ETH",
                "data": {
                  "token_id": "",
                  "id": "",
                  "token_address": "",
                  "decimals": 18,
                  "quantity": "43100000000000000"
                }
              },
              "timestamp": "2022-04-04T13:52:19.926261Z"
            }
    */
    public function _getDeposit($id) {
        $response = Http::acceptJson()
            ->get(
                'https://api.ropsten.x.immutable.com/v1/deposits/' . $id
            );
        echo $response->getBody();
    }

    /*
        @name  : get_signable_deposit_details
        @method: post
        @usage : Gets details of a signable deposit
        @params: 
            body params: 
                string amount required: Amount of the token the user is depositing
                object token required: 
                    string data: 
                    string type:
                string user required: User who is depositing
        @return: 
            //
    */
    public function _get_signable_deposit_details(Request $request) {
        $body = [];
        $body['amount'] = $request->amount;
        $body['token'] = $request->token;
        $body['user'] = $request->user;

        $response = Http::acceptJson()
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(
                'https://api.ropsten.x.immutable.com/v1/signable-deposit-details',
                $body
            );
        echo $response->getBody();
    }

}
