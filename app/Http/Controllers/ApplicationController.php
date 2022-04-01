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
        @usage : get all applications
        @params: 
        @return: json
    */
    public function getApplications() {

        // if api key exist
        // $response = Http::acceptJson()
        // ->withHeaders([
        //     'x-api-key'=> '0xa7aefead2f25972d80516628417ac46b3f2604af'
        // ])->get(
        //     'api.ropsten.x.immutable.com/v1/applications'
        // );
        $response = Http::acceptJson()
        ->get(
            'https://api.ropsten.x.immutable.com/v1/applications'
        );
        echo $response->getBody();
    }

    /*
        @usage : get detail of an application with the given id
        @params: 
            $id : application id 
        @return: json
    */
    public function getApplicationDetail($id) {

        // if api key exist
        // $response = Http::acceptJson()
        // ->withHeaders([
        //     'x-api-key'=> '0xa7aefead2f25972d80516628417ac46b3f2604af'
        // ])->get(
        //     'https://api.ropsten.x.immutable.com/v1/applications/' . $id
        // );
        
        $response = Http::acceptJson()
        ->get(
            'https://api.ropsten.x.immutable.com/v1/applications/' . $id
        );
        echo $response->getBody();
    }
}
