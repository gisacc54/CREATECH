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

        if ($level == 3){
            if ($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] == 1){
                $response = "CON Enter your account pin";
            }
        }

        if ($level == 4){
            if ($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] == 1){
                $response = "CON you have recharged My Account amount $ussd_string_exploded[2] Select \n1. Via Wallet or \n2. Via Credit Card";

            }
        }

        if($level == 5){
            if ($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] == 1){

                $pin = $ussd_string_exploded[3];
                $amount = $ussd_string_exploded[2];
                $phoneNum = str_replace('+',"",$phoneNumber);
                $user = UssdPin::where('phone_number',$phoneNum)->first();

                if ($user->pin != $pin){
                    $response = "END Invalid Pin";
                } else{
                    $request['amount'] = $amount;
                    $request['phone_number'] = $phoneNumber;
                    $request["user_id"] = $user->user_id;

                    if($ussd_string_exploded[4] == 2){
                        $request['credit_card'] = true;
                    }else{
                        $request['credit_card'] = false;
                    }

                    $resp = $this->buyAirtime($request);

                    $response = "END $resp->message";
                }
            }

        }
        // Echo the response back to the API
        header('Content-type: text/plain');
        echo $response;
    }

    public function buyAirtime($request,$isMe = true)
    {
        if ($isMe){
            $request['description'] = "You have buy TZS $request->amount airtime for your phone number $request->phone_number";
        }
        else{
            $request['description'] = "You have buy TZS $request->amount airtime for your friend phone number $request->phone_number";
        }

        $request["transaction_type"] = "Withdraw";


        if ($request->credit_card){
            $request['from'] = "Credit-Card";
            //TODO: deduct amount from your credit card

            Transaction::create($request->all());

            //TODO: add points
            $point = Point::where('user_id',$request->user_id)->first();
            $point->point += ($request->amount/100);
            $point->save();

            MainService::SendAirTime($request);
            return (object)[
                'status'=>true,
                'message' => " Credited successful"
            ];
        }
        $wallet = Wallet::where('user_id',$request->user_id)->first();
        if ( $wallet->amount < $request->amount){
            return (object)[
                'status'=>false,
                'message' => "Insufficient balance"
            ];
        }


        //TODO: record transaction
        $request['from'] = "Wallet";
        Transaction::create($request->all());
        //TODO: deduct balance
        $wallet->amount -= $request->amount;
        $wallet->save();

        //TODO: add points
        $point = Point::where('user_id',$request->user_id)->first();
        $point->point += ($request->amount/100);
        $point->save();
        //TODO: buy airtime

        MainService::SendAirTime($request);

        return (object)[
            'status'=>true,
            'message' => "Credited successful"
        ];
    }
}

