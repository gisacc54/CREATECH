<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function showUserManagementPanel(){
        return view('admin.users.index');
    }

    public function showCreateUserAccountPanel(){
        $roles = Role::orderBy('id','desc')->get();
        return view('admin.users.create',compact('roles'));
    }

    public function createUserAccount(Request $request){

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'phone_number' => 'required|unique:users',
            'gender' => 'required',
            'dob' => 'required|date_format:Y-m-d',
            'role_id' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $request['password'] = Hash::make($request->password);
        User::create($request->all());
        if ($request->close)
        {
            return back()->withSuccess('User account created successful!')->withInput($request->only('close'));
        }
        return redirect(route('admin.users.management'))->withSuccess('User account created successful!');
    }

    public function showUpdateUserAccountPanel($id){
        $user = User::find($id);
//        $roles = Role::all();
        $roles = Role::orderBy('id','desc')->get();
        return view('admin.users.update',compact('user','roles'));
    }

    public function updateUserAccount(Request $request, $id){

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'phone_number' => 'required|unique:users,phone_number,'.$id,
            'gender' => 'required',
            'dob' => 'required|date_format:Y-m-d',
            'status' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::find($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->status = $request->status;
        $user->role_id = $request->role_id;
        $user->save();

        if ($request->close)
        {
            return back()->withSuccess('User account updated successful!')->withInput($request->only('close'));
        }
        return redirect(route('admin.users.management'))->withSuccess('User account updated successful!');
    }

    //Ajax functions
    public function ajaxGetUsers(Request $request){
        $limit = $request->input( 'limit' )??5;
        $q = $request->input( 'q' );
        $users = DB::table('users AS t1')->select("t1.id","t1.username","t1.first_name","t1.last_name","t1.profile_image","t1.phone_number","t1.email","t1.status","t1.role_id","t2.name as role_name",DB::raw("DATE_FORMAT(t1.created_at, '%W, %D %M %Y %h:%i:%S%p') as created_at"),DB::raw("DATE_FORMAT(t1.updated_at, '%W, %D %M %Y %h:%i:%S%p') as updated_at"))->leftJoin("roles as t2","t1.role_id","=","t2.id")
            ->where('email', 'LIKE', '%' . $q . '%')
            ->orWhere('username', 'LIKE', '%' . $q . '%')
            ->orWhere('first_name', 'LIKE', '%' . $q . '%')
            ->orWhere('last_name', 'LIKE', '%' . $q . '%')
            ->orWhere('phone_number', 'LIKE', '%' . $q . '%')
            ->orWhere('email', 'LIKE', '%' . $q . '%')
            ->orWhere('status', 'LIKE', '%' . $q . '%')
            ->orWhere('t2.name', 'LIKE', '%' . $q . '%')
            ->paginate($limit);
        return $users;
    }
}
