<?php

namespace App\Services;

use AfricasTalking\SDK\AfricasTalking;

class MainService
{
    public static function SendAirTime($contact): void
    {

        $username = "sandbox";

        $apikey   = "29f447234ae07cec03ef7c5b7dec231e35592ec152f96008bcf048409c2c2cb8";

        // Initialize the SDK
        $AT       = new AfricasTalking($username, $apikey);

        // Get the airtime service
        $airtime  = $AT->airtime();


        // Set the phone number, currency code and amount in the format below
        $recipients = [[
            "phoneNumber"  => "+".$contact->phone_number,
            "currencyCode" => "TZS",
            "amount"       => $contact->amount
        ]];

        try {
            // That's it, hit send and we'll take care of the rest
            $results = $airtime->send([
                "recipients" => $recipients
            ]);
        } catch(Exception $e) {
//            dd($e->getMessage());
        }
    }
}
