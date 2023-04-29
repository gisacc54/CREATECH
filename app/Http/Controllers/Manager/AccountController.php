<?php

namespace App\Http\Controllers\Manager;

use App\Helper\AuthHelper;
use App\Http\Controllers\Controller;
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
        return view('manager.account.index',compact('user'));
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
}
