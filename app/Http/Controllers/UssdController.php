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
    public $data = [
        //question start
        [
            'question'=>'What is the largest organ in the human body',
            'answer'=>[
                [
                    'value'=>'skin',
                    'is_correct'=>true
                ],
                [
                    'value'=>'Heart',
                    'is_correct'=>false
                ]

            ]
        ],
        [
            'question'=>'Which planet in our solar system is known for its rings',
            'answer'=>[
                [
                    'value'=>'Saturn',
                    'is_correct'=>true
                ],
                [
                    'value'=>'Mars',
                    'is_correct'=>false
                ]

            ]
        ],
//        [
//            'question'=>'What is the process by which plants convert sunlight into energy called?',
//            'answer'=>[
//                [
//                    'value'=>'Photosynthesis',
//                    'is_correct'=>true
//                ],
//                [
//                    'value'=>'Respiration',
//                    'is_correct'=>false
//                ]
//
//            ]
//        ],
//        [
//            'question'=>'What is the name of the smallest bone in the human body?',
//            'answer'=>[
//                [
//                    'value'=>'Stapes',
//                    'is_correct'=>true
//                ],
//                [
//                    'value'=>'Humerus',
//                    'is_correct'=>false
//                ]
//
//            ]
//        ],
//        [
//            'question'=>'Which war was fought between the United States and Spain in 1898?',
//            'answer'=>[
//                [
//                    'value'=>'Spanish-American War',
//                    'is_correct'=>true
//                ],
//                [
//                    'value'=>'World War I',
//                    'is_correct'=>false
//                ]
//
//            ]
//        ],
//        [
//            'question'=>'Who is the riches man in the world',
//            'answer'=>[
//                [
//                    'value'=>'Elon Musk',
//                    'is_correct'=>true
//                ],
//                [
//                    'value'=>'George Bush',
//                    'is_correct'=>false
//                ]
//
//            ]
//        ],



        //question end
    ];
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
            $response = "CON Welcome to Gamika\n";
            $response .= "1. Play Game \n";
            $response .= "2. Buy Airtime \n";
            $response .= "3. My Account \n";

        } else if ($text == "1") {
            // Business logic for first level response
            $response = "CON Select Category \n";
            $response .= "1. General \n";
            $response .= "2. Sports \n";
            $response .= "3. Health \n";


        } else if ($text == "2") {
            $response = "END Your phone number is ".$phoneNumber;

        } else if($text == "1*1") {
            // This is a second level response where the user selected 1 in the first instance
            $response = "CON select level\n";
            $response .= "1. Easy\n";
            $response .= "2. Hard\n";
            // This is a terminal request. Note how we start the response with END

        }



        if ($level == 3){
            if ($ussd_string_exploded[0]== 1 && $ussd_string_exploded[1] == 1 && $ussd_string_exploded[2] == 1 ){
                $response = "CON Enter Amount";

            }
        }

        if ($level == 4 ){
            if ($ussd_string_exploded[0]== 1 && $ussd_string_exploded[1] == 1 && $ussd_string_exploded[2] == 1 ){
                //TODO: take amount and deduct from wallet
                $response = "CON Enter PIN";
            }
        }
        if ($level == 5 ){
            if ($ussd_string_exploded[0]== 1 && $ussd_string_exploded[1] == 1 && $ussd_string_exploded[2] == 1 ){
                //TODO: take amount and deduct from wallet
                $request = new Request();

                $request['amount'] = $ussd_string_exploded[3];
                $request['pin'] = $ussd_string_exploded[4];
                $request['phone_number'] = str_replace('+','',$phoneNumber);

//                $response = "CON $request->pin";
                $resp = $this->deductAmountFromWallet($request);
                if (!$resp->status){
                    $response = "CON $resp->message";
                }else{
                    $questions = $resp->data;
                    $questionData = $questions[0];
                    $response = "CON $questionData->question\n";
                    $i = 1;
                    foreach ($questionData->answer as $answer){
                        $response .="$i. $answer->value\n";
                        $i++;
                    }
                }


            }
        }

        if ($level == 6 ){
            if ($ussd_string_exploded[0]== 1 && $ussd_string_exploded[1] == 1 && $ussd_string_exploded[2] == 1 ){

                $questions = $this->data;
                $questionData = $questions[1];
                $response = "CON $questionData->question\n";
                $i = 1;
                foreach ($questionData->answer as $answer){
                    $response .="$i. $answer->value\n";
                    $i++;
                }
            }
        }

//        if ($level == 6 ){
//            if ($ussd_string_exploded[0]== 1 && $ussd_string_exploded[1] == 1 && $ussd_string_exploded[2] == 1 ){
//
//                $questions = Data::$data;
//                $questionData = $questions[1];
//                $response = "CON $questionData->question\n";
//                $i = 1;
//                foreach ($questionData->answer as $answer){
//                    $response .="$i. $answer->value\n";
//                    $i++;
//                }
//            }
//        }

        echo $response;
    }

    public function deductAmountFromWallet($request)
    {

        $pin = UssdPin::where('phone_number',$request->phone_number)->get();

        if ($pin->pin != $request->pin){
            return (object)[
                'status'=>false,
                'message'=>"END invalid pin"
            ];
        }
//
        $request['description'] = "You have buy a Game Chance at Gemika TZS $request->amount";
        $request['user_id'] = $pin->user_id;
        $request['transaction_type'] = 'Withdraw';
        $request['from'] = 'Wallet';

        Transaction::create($request);

        $wallet = Wallet::where('user_id',$request->user_id);

        if ($wallet->amount < $request->amount){
            return (object)[
                'status'=>false,
                'message' => "Insufficient balance"
            ];
        }
        //TODO: deduct balance
        $wallet->amount -= $request->amount;
        $wallet->save();

        $questions = $this->data;

        return (object)[
          'status'=>true,
          'data'=>$questions
        ];

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


