<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Token;
use App\Models\Txn;

class FirstPageController extends Controller
{
    public function __construct() {
        ini_set('max_execution_time', 10000000);
    }

    public function index() {

    }

    public function getUniqueWalletCnt() {
        $uniqueTokens = Token::groupBy('user')->orderBy('id')->get();
        $cnt = 0
        if (isset($uniqueTokens)) {
            $cnt = sizeof($uniqueTokens);
        }

        return $cnt;
    }

    public function getMintingDropTime($f_txn_id, $l_txn_id) {
        $f_txn = Txn::where('id', '=', $f_txn_id)->first();
        $l_txn = Txn::where('id', '=', $l_txn_id)->first();

        $f_txn_time = $f_txn->txn_time;
        $l_txn_time = $l_txn->txn_time;

        $duration = ($l_txn - $f_txn) / 1000;

        $hours = $duration / 3600;
        $mins = ($duration % 3600) / 60;
        $secs = ($duration % 3600) % 60;

        $duration_timeformat = "";
        if ($hours != 0) $duration += ($hours . " Hour(s)");
        if ($mins != 0) $duration += ($mins . " Min(s)"); 
        $duration += ($secs . " Seconds");

        return $duration_timeformat;
    }

    public function standardiseMintsTime($f_txn_id, $l_txn_id) {
        $f_txn = Txn::where('id', '=', $f_txn_id)->first();
        $l_txn = Txn::where('id', '=', $l_txn_id)->first();

        $f_txn_time = $f_txn->txn_time;
        $l_txn_time = $l_txn->txn_time;

        $mins = ($l_txn - $f_txn) / 1000 / 60;

        $rlt = ($l_txn_id - $f_txn_id) / $secs;

        return $rlt;
    }

    
}
