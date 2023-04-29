<?php

namespace App\Services;

use AfricasTalking\SDK\AfricasTalking;

class MainService
{
    public static function SendAirTime($contact): void
    {

        $username = "sandbox";

        $apikey   = "610de44f8d182e470c7d87e5ae1edc772e97b84d4b5034cc3adf3779cab9e454";

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
