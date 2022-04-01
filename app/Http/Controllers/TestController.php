<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller {
    public function getTest() {
        $response = Http::acceptJson()
        ->withHeaders([
            'x-api-key'=> '0xa7aefead2f25972d80516628417ac46b3f2604af'
        ])->get(
            'api.ropsten.x.immutable.com/v1/applications'
        );
        echo $response->getBody();
    }
}
