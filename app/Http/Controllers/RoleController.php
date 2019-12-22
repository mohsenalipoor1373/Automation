<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;

class RoleController extends Controller
{

    public function wizard()
    {
        $permissions = Permission::all();
        return view('roles.wizard', compact('permissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('roles.edit', compact('permission', 'role', 'rolePermissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return ReturnMsgSuccess('بخش جدید در سیستم ثبت شد');
    }

    public function show(Request $request)
    {
        $roles = Role::get();
        return view('roles.show', compact('roles'));
    }

    public function update(Request $request)
    {
        $id = $request['id'];
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return ReturnMsgSuccess('مشخصات بخش با موفقیت در سیستم ثبت شد');
    }

    public function delete(Role $id)
    {
        $id->delete();
        return ReturnMsgError('مشخصات پرسنل با موفقیت حذف شد');
    }

    public function lock()
    {
        return view('lock');

    }

    public function checklock(Request $request)
    {
        $current_password = Auth::User()->password;
        if (Hash::check($request['pass'], $current_password)) {
            return view('home');
        } else
            return ReturnMsgError('کلمه عبور صحیح نمیباشد!');


    }
}
