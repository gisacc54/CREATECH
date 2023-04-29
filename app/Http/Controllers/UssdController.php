<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Transaction;
use App\Models\UssdPin;
use App\Models\Wallet;
use App\Services\MainService;
use Illuminate\Http\Request;

class UssdController extends Controller
{
    public function ussd(Request $request)
    {
        $sessionId      = $request->get('sessionId');
        //serviceCode: your USSD code
        $serviceCode    = $request->get('serviceCode');
        $phoneNumber    = $request->get('phoneNumber');
        //text: user input in form of a string
        $text           = $request->get('text');


        $ussd_string_exploded = explode("*", $text);

        $level = count($ussd_string_exploded);


        if ($text == "") {
            // This is the first request. Note how we start the response with CON
            $response = "CON Welcome to Gamika\n $level";
            $response .= "1. Play Game \n";
            $response .= "2. My Account \n";

        } else if ($text == "1") {
            // Business logic for first level response
            $response = "CON Select Category \n $level";
            $response .= "1. General \n";
            $response .= "2. Sports \n";
            $response .= "3. Health \n";


        } else if ($text == "2") {
            $response = "END Your phone number is ".$phoneNumber;

        } else if($text == "1*1") {
            // This is a second level response where the user selected 1 in the first instance
            $response = "CON select level\n";
            $response .= "1. Easy\n";
            $response .= "1. Hard\n";
            // This is a terminal request. Note how we start the response with END

        }


        if ($level )
        echo $response;
    }
}

