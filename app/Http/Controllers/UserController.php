<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userManager()
    {
        $all_users = User::orderBy('id', 'desc')->get();
        $all_roles = Role::all();

        return view('user.usermanager', compact('all_users', 'all_roles'));
    }

    public function userCreatedone(Request $request)
    {
        try {
            $user_name = $request->username;
            $user_email = $request->email;
            $user_password = $request->password;
            $selected_roles = $request->role;

            $user = new User;
            $user->name = $user_name;
            $user->email = $user_email;
            $user->password = Hash::make($user_password);
            $user->save();

            User::find($user->id)->assignRole($selected_roles);

            return redirect()->back();
        } catch (Throwable $e) {
            report($e);
            return $e;
        }
    }

    public function roleAssign(Request $request)
    {
        $selected_roles = $request->input('role');

        $email = $request->email;
        $userbyemail = User::where('email', $email)->get();
        $idbyemail = $userbyemail[0]->id;

        User::find($idbyemail)->assignRole($selected_roles);

        return redirect()->back();
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        $allRoles = Role::all();
        $assignedRoles  = $user->roles->pluck('id')->toArray();
        return view('user.useredit', compact('user'), compact('allRoles'))->with('assignedRoles', $assignedRoles);
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $new_user = $request->username;
        $new_email = $request->email;
        $user->name = $new_user;
        $user->email = $new_email;
        $user->save();

        $selected_roles = $request->input('role');
        User::find($id)->syncRoles($selected_roles);

        return redirect('/usermanager');
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
        $user->delete();
        return redirect('/usermanager');
    }

    public function userCreate()
    {
        $all_roles = Role::all();
        return view('user.usercreate', compact('all_roles'));
    }
}
