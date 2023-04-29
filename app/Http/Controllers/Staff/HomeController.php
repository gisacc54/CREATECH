<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\MainService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showStaffDashboard()
    {
        return view('staff.dashboard.index');
    }

    public function buyAirTime(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'phone_number' => 'required',
        ]);


        if ($request->phone_number == auth()->user()->phone_number){
            $request['description'] = "You have buy TZS $request->amount airtime for your phone number $request->phone_number";
        }
        else{
            $request['description'] = "You have buy TZS $request->amount airtime for your friend phone number $request->phone_number";
        }

        $request["transaction_type"] = "Withdraw";
        $request["user_id"] = auth()->id();

        if ($request->credit_card){
            $request['from'] = "Credit-Card";
            //TODO: deduct amount from your credit card

            Transaction::create($request->all());
            MainService::SendAirTime($request);
            return back()->withSuccess('You successful by airtime');
        }
        $wallet = Wallet::where('user_id',auth()->id())->first();
        if ( $wallet->amount < $request->amount){
            return back()->withError("Insufficient balance");
        }



        //TODO: record transaction
        $request['from'] = "Wallet";
        Transaction::create($request->all());
        //TODO: deduct balance
        $wallet->amount -= $request->amount;
        $wallet->save();

        //TODO: add points
        $point = Point::where('user_id',auth()->id())->first();
        $point->point += ($request->amount/100);
        $point->save();
        //TODO: buy airtime

        MainService::SendAirTime($request);

        return back()->withSuccess('You successful by airtime');
    }


    public function transaction()
    {
        return view('staff.dashboard.transaction');
    }
}
