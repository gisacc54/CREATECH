<?php

namespace App\Helper;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthHelper
{
    public static function redirectTo($roleName){
        $roles = config('constant.roles');

        foreach ($roles as $role){
            $role =(object)$role;
            if($roleName == $role->name){
                return $role->home;
            }
        }
    }

    public static function changePassword(int $id,string $password): bool
    {
        $user = User::find($id);
        $user->password = Hash::make($password);
        if ($user->save()){
            return true;
        }
        return false;
    }
}
