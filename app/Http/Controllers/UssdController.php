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
            $response  = "CON What would you want to check \n";
            $response .= "1. Buy Airtime \n";
            $response .= "2. Update Account";

        } else if ($text == "1") {
            // Business logic for first level response
            $response = "CON Choose account information you want to view \n";
            $response .= "1. My Number \n";
            $response .= "2. For a Friend \n";

        } else if ($text == "2") {
            // Business logic for first level response
            // This is a terminal request. Note how we start the response with END
            $response = "END Your phone number is ".$phoneNumber;

        } else if($text == "1*1") {
            // This is a second level response where the user selected 1 in the first instance

            // This is a terminal request. Note how we start the response with END
            $response = "CON Enter amount";

        }
    }
}

