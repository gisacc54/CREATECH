<?php

namespace App\Http\Controllers\Admin;

use App\Helper\AuthHelper;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AccountController extends Controller
{
    public function showMyAccountPanel()
    {
        $user = auth()->user();
        return view('admin.account.index',compact('user'));
    }
    public function showAccountPanel($id){
        $user = User::find($id);
        return view('admin.account.index',compact('user'));
    }

    public function changeAccountPassword(Request $request, $id)
    {
        if (auth()->user()->id == $id)
        {
            $user  = auth()->user();
            $this->validate($request, [
                'current_password' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);
            if (!Hash::check($request->current_password,$user->password)){
                return back()->withError("Incorrect current password!");
            }
        }
        else{
            $this->validate($request, [
                'password' => 'required|confirmed|min:8',
            ]);
        }

        if (!AuthHelper::changePassword($id,$request->password))
            return back()->withError('Fail To change password!');

        return  back()->withSuccess('Password changed successful!');
    }

    public function changeAccountProfileImage(Request $request,$id)
    {
        $this->validate($request, [
            'imageUpload' => 'required',
        ]);
        $input = $request->all();
        if (!($input['base64image'] || $input['base64image'] != '0')) {
            return back()->withError('Fail To update Profile image!');
        }
        $user = User::find($id);
        $folderPath = '/upload/profile/image/';
        $image_parts = explode(";base64,", $input['base64image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        // $file = $folderPath . uniqid() . '.png';
        $filename = "profile-image-".$id. '.'. $image_type;
        $file =$folderPath.$filename;
        file_put_contents(public_path($file), $image_base64);

        $thumbnailFile = $folderPath."thumbnail/".$filename;
        $img = Image::make(public_path($file));
        $img->resize(50, 50, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path($thumbnailFile));
        $user->profile_image = $file;
        $user->profile_image_thumbnail = $thumbnailFile;
        $user->save();
        return back()->withSuccess('Profile image updated successful!');
    }

    public function addBalance(Request $request,$id)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);

        $request['user_id'] = $id;
        $request['transaction_type'] = "Deposit";
        $request['from'] = "Credit-Card";
        $request['description'] = "Deposited TZS $request->amount  from your Credit-Card";


        Transaction::create($request->all());

        $wallet = Wallet::where('user_id',$id)->first();
        $wallet->amount += $request->amount;


        $wallet->save();
        return back()->withSuccess('Balance added successful int wallet.');
    }
}
