<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApplicationController extends Controller
{   

    /*
        @usage : display Applications
        @params: 
        @return: view
    */
    public function index() {

    }


    /*
        @name  : getApplications
        @usage : get all applications
        @params: 
            integer : page_size  :  Page size of the result
            string : cursor : Cursor
            string : order_by : Property to sort by
            string : direction : Direction to sort(asc/desc)
        @return: 
            {
              "result": [
                {
                  "id": "12f2d631-db48-8891-350c-c74647bb5b7f",
                  "name": "Guilds Of Guardians",
                  "created_at": "2021-07-02T02:54:02.592523Z"
                },
                {
                  "id": "8a2d8baa-8bff-4061-bdd3-07a3cad3179a",
                  "name": "Epics GG",
                  "created_at": "2021-04-19T11:05:29.654452Z"
                }
              ],
              "cursor": "eyJpZCI6IjhhMmQ4YmFhLThiZmYtNDA2MS1iZGQzLTA3YTNjYWQzMTc5YSIsImNyZWF0ZWRfYXQiOiIyMDIxLTA0LTE5VDExOjA1OjI5LjY1NDQ1MloifQ",
              "remaining": 0
            }
    */
    public function _getApplications(Request $request) {
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

        $url = 'https://api.x.immutable.com/v1/applications';
        
        $response = Http::acceptJson()
            ->get(
                $url,
                $body
            );
        echo $response->getBody();
    }


    /*
        @name  : getApplicationDetail
        @usage : get detail of an application with the given id
        @params: 
            $id : application id 
        @return: 
            {
              "id": "12f2d631-db48-8891-350c-c74647bb5b7f",
              "name": "Guilds Of Guardians",
              "created_at": "2021-07-02T02:54:02.592523Z"
            }
    */
    public function _getApplicationDetail($id) {
 
        $response = Http::acceptJson()
            ->get(
                'https://api.ropsten.x.immutable.com/v1/applications/' . $id
            );
        echo $response->getBody();
    }
}
