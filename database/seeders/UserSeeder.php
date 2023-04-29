<?php

namespace Database\Seeders;

use App\Models\Point;
use App\Models\User;
use App\Models\UssdPin;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => "Admin",
            'first_name' => "System",
            'last_name' => "Admin",
            'phone_number' => "255765513651",
            'email' => "admin@test.com",
            'role_id' => 1,
            'gender' => 'Male',
            'dob' => '1999-07-01',
            'password' => \Illuminate\Support\Facades\Hash::make("123456"),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => "Manager",
            'first_name' => "System",
            'last_name' => "Manager",
            'phone_number' => "255765513652",
            'email' => "manager@test.com",
            'role_id' => 2,
            'gender' => 'Male',
            'dob' => '1999-07-01',
            'password' => \Illuminate\Support\Facades\Hash::make("123456"),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        $user = User::create([
            'username' => "Staff",
            'first_name' => "Normal",
            'last_name' => "Staff",
            'phone_number' => "255765513653",
            'email' => "staff@test.com",
            'role_id' => 3,
            'gender' => 'Male',
            'dob' => '1999-07-01',
            'password' => \Illuminate\Support\Facades\Hash::make("123456"),
        ]);

        Wallet::create([
            'user_id'=> $user->id,
            'account'=> "1000241300$user->id",
        ]);

        $year = Carbon::parse("1999-07-01")->format("Y");
        UssdPin::create([
            'user_id'=> $user->id,
            'phone_number'=> $user->phone_number,
            'pin'=>$year,
        ]);

        Point::create([
            'user_id'=> $user->id,
        ]);
    }
}
