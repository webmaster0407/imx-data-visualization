<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AssetController extends Controller
{

    private $base_url = "https://api.x.immutable.com/v1";
    /*
        @name  : index
        @usage : display Applications
        @params: 
        @return: view
    */
    public function index() {

    }

    /*
        @name  : getAssets
        @usage : get all applications
        @params: 
            integer page_size : Page size of the result
            string cursor : Cursor
            string order_by : Property to sort by
            string direction : Direction to sort (asc/desc)
            string user     : Ethereum address of the user who owns these assets
            string status   : Status of these assets
            string name     : Name of the asset to search
            string metadata : JSON-encoded metadata filters for these asset
            boolean sell_orders : Set flag to true to fetch an array of sell order details with accepted status associated with the asset
            boolean buy_orders  : Set flag to true to fetch an array of buy order details with accepted status associated with the asset
            boolean include_fees: Set flag to include fees associated with the asset
            string collection : Collection contract address
            string updated_min_timestamp : Minimum timestamp for when these assets were last updated
            string updated_max_timestamp : Maximum timestamp for when these assets were last updated
            string auxiliary_fee_percentages : Comma separated string of fee percentages that are to be paired with auxiliary_fee_recipients
            string auxiliary_fee_recipients : Comma separated string of fee recipients that are to be paired with auxiliary_fee_percentages
        @return: 
            {
              "result": [
                {
                  "token_address": "0xf2066bfe49c8cf73744357f5889ef8e5483f1883",
                  "token_id": "9999999999",
                  "id": "9999999999",
                  "user": "0xfafdd12acbbb749d337391e13ba9533749c4b99b",
                  "status": "eth",
                  "uri": "uri/1",
                  "name": null,
                  "description": null,
                  "image_url": null,
                  "metadata": {},
                  "collection": {
                    "name": "Armstrong Moon",
                    "icon_url": "https://storage.googleapis.com/app-aglet-mobile.appspot.com/public_sneakers/1MA-NONDA-MUN_Neil%20Armstrong_Moon%20Boost.png"
                  },
                  "created_at": "2022-03-16T11:02:24.732921Z",
                  "updated_at": "2022-03-16T11:03:02.236044Z"
                }
              ],
              "cursor": "eyJjb250cmFjdF9hZGRyZXNzIjoiMHhmMjA2NmJmZTQ5YzhjZjczNzQ0MzU3ZjU4ODllZjhlNTQ4M2YxODgzIiwiaWQiOiI5OTk5OTk5OTk5IiwiY2xpZW50X3Rva2VuX2lkIjoiOTk5OTk5OTk5OSIsIm93bmVyX2FkZHJlc3MiOiIweGZhZmRkMTJhY2JiYjc0OWQzMzczOTFlMTNiYTk1MzM3NDljNGI5OWIiLCJzdGF0dXMiOiJldGgiLCJ1cmkiOiJ1cmkvMSIsIm5hbWUiOm51bGwsImRlc2NyaXB0aW9uIjpudWxsLCJpbWFnZV91cmwiOm51bGwsIm1ldGFkYXRhIjp7fSwibGFzdF9tZXRhZGF0YV9yZWZyZXNoX3RpbWUiOjE2NDc0Mjg1ODIsImxhc3RfdXBkYXRlX3RyYW5zYWN0aW9uX2hhc2giOiIweDhmOTEwOGNhZThlZDI0NmUzODRiZmUzMDc3YmI0NDZmOGQ0MWY0MGQyMmM2M2VhYjkwMjg2NDIwODI2OTliNzYiLCJsYXN0X3VwZGF0ZV9ibG9ja19udW1iZXIiOjEyMDkzMTE3LCJjcmVhdGVkX2F0IjoiMjAyMi0wMy0xNlQxMTowMjoyNC43MzI5MjFaIiwidXBkYXRlZF9hdCI6IjIwMjItMDMtMTZUMTE6MDM6MDIuMjM2MDQ0WiIsImNvbGxlY3Rpb25fbmFtZSI6IkFybXN0cm9uZyBNb29uIiwiY29sbGVjdGlvbl9pY29uX3VybCI6Imh0dHBzOi8vc3RvcmFnZS5nb29nbGVhcGlzLmNvbS9hcHAtYWdsZXQtbW9iaWxlLmFwcHNwb3QuY29tL3B1YmxpY19zbmVha2Vycy8xTUEtTk9OREEtTVVOX05laWwlMjBBcm1zdHJvbmdfTW9vbiUyMEJvb3N0LnBuZyIsIlNlbGxPcmRlciI6bnVsbCwiQnV5T3JkZXIiOm51bGwsIm9yaWdpbmF0b3JfYWRkcmVzcyI6IiIsImZlZV9wZXJjZW50YWdlIjowLCJUc3YiOiIifQ",
              "remaining": 1
            }
    */
    public function _getAssets(Request $request) {
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
        if ($request->name !== null) {
            $body['name'] = $request->name;
        }
        if ($request->metadata !== null) {
            $body['metadata'] = $request->metadata;
        }
        if ($request->sell_orders !== null) {
            $body['sell_orders'] = $request->sell_orders;
        }
        if ($request->buy_orders !== null) {
            $body['buy_orders'] = $request->buy_orders;
        }
        if ($request->include_fees !== null) {
            $body['include_fees'] = $request->include_fees;
        }
        if ($request->collection !== null) {
            $body['collection'] = $request->collection;
        }
        if ($request->updated_min_timestamp !== null) {
            $body['updated_min_timestamp'] = $request->updated_min_timestamp;
        }
        if ($request->updated_max_timestamp !== null) {
            $body['updated_max_timestamp'] = $request->updated_max_timestamp;
        }
        if ($request->updated_max_timestamp !== null) {
            $body['auxiliary_fee_percentages'] = $request->auxiliary_fee_percentages;
        }
        if ($request->updated_max_timestamp !== null) {
            $body['auxiliary_fee_recipients'] = $request->auxiliary_fee_recipients;
        }
        $response = Http::acceptJson()
        ->get(
            $this->base_url . '/assets',
            $body
        );
        echo "<pre>";
        print_r(json_decode($response->getBody(), true));
        echo "</pre>";
    }

    /*
        @usage : get detail of an application with the given id
        @params: 
            string required $token_address : Address of the ERC721 contract
            string required $token_id    : Either ERC721 token ID or internal IMX ID

            string include_fees : Set flag to include fees associated with the asset
        @return: 
            {
              "token_address": "0xf2066bfe49c8cf73744357f5889ef8e5483f1883",
              "token_id": "9999999999",
              "id": "9999999999",
              "user": "0xfafdd12acbbb749d337391e13ba9533749c4b99b",
              "status": "eth",
              "uri": "uri/1",
              "name": null,
              "description": null,
              "image_url": null,
              "metadata": {},
              "collection": {
                "name": "Armstrong Moon",
                "icon_url": "https://storage.googleapis.com/app-aglet-mobile.appspot.com/public_sneakers/1MA-NONDA-MUN_Neil%20Armstrong_Moon%20Boost.png"
              },
              "created_at": "2022-03-16T11:02:24.732921Z",
              "updated_at": "2022-03-16T11:03:02.236044Z"
            }
    */
    public function _getAssetDetail(Request $request, $token_address, $token_id) {
        $body = [];
        if ($request->include_fees !== null) {
            $body['include_fees'] = $request->include_fees;
        }
        
        // $response = Http::acceptJson()
        //     ->get(
        //         'https://api.ropsten.x.immutable.com/v1/assets/' . $token_address . '/' . $token_id,
        //         $body
        //     );
        $response = Http::acceptJson()
            ->get(
                $this->base_url . '/assets/' . $token_address . '/' . $token_id,
                $body
            );

        echo "<pre>";
        print_r(json_decode($response->getBody(), true));
        echo "</pre>";
    }
}
