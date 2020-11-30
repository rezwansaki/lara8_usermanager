<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Session\Session;

class RoleController extends Controller
{
    public function roleManager()
    {
        $all_roles = Role::all();
        return view('role.rolemanager', compact('all_roles'));
    }

    public function roleCreate(Request $request)
    {
        try {
            $role_name = $request->rolename;
            $role = Role::create(['name' => $role_name]);
            return redirect()->back();
        } catch (Throwable $e) {
            report($e);
            return 'This role is already exist.';
        }
    }

    public function roleEdit($id)
    {
        $role = Role::find($id);
        return view('role.roleedit', compact('role'));
    }

    public function roleUpdate(Request $request, $id)
    {
        $role = Role::find($id);
        $new_role = $request->rolename;
        $role->name = $new_role;
        $role->save();
        return redirect('/rolemanager');
    }

    public function roleDelete($id)
    {
        $role = Role::find($id);
        $role->users()->detach();
        $role->delete();
        return redirect('/rolemanager');
    }
}
