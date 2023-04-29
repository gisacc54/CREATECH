<?php

namespace App\Http\Controllers\Staff;

use App\Helper\AuthHelper;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AccountController extends Controller
{
    public function showMyAccountPanel()
    {
        $user = auth()->user();

        $creditCard = PaymentMethod::where('user_id',$user->id)->first();
        $point = Point::where('user_id',$user->id)->first();
        if (!$creditCard){
            $creditCard = new PaymentMethod();
        }
        return view('staff.account.index',compact('user','creditCard','point'));
    }

    public function changeAccountPassword(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->current_password,auth()->user()->password)){
            return back()->withError("Incorrect current password!");
        }

        if (!AuthHelper::changePassword($id,$request->password))
            return back()->withError('Fail To change password!');

        return  back()->withSuccess('Password changed successful!');
    }

    public function addCreditCard(Request $request)
    {
        $this->validate($request, [
            'account' => 'required',
            'name' => 'required',
            'cvv' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        $request['user_id'] = auth()->id();
        $creditCard = PaymentMethod::where('user_id',auth()->id())->first();
        if (!$creditCard){
            PaymentMethod::create($request->all());
            return  back()->withSuccess('Credit Cad information created successful');
        }

            $creditCard->account = $request->account;
            $creditCard->name = $request->name;
            $creditCard->cvv = $request->cvv;
            $creditCard->month = $request->month;
            $creditCard->year = $request->year;
            $creditCard->save();

        return  back()->withSuccess('Credit Cad information updated successful');
    }
}
