<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function userManager()
    {
        $all_users = User::all();
        $all_roles = Role::all();

        return view('user.usermanager', compact('all_users', 'all_roles'));
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
        return view('user.useredit', compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $new_user = $request->username;
        $new_email = $request->email;
        $user->name = $new_user;
        $user->email = $new_email;
        $user->save();
        return redirect('/usermanager');
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
        $user->delete();
        return redirect('/usermanager');
    }
}
