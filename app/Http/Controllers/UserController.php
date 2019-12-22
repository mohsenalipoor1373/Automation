<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;

class UserController extends Controller
{


    public function wizard(User $id)
    {
        $roles = Role::all();
        $userRoles = $id->roles->pluck('id')->all();
        return view('users.wizard', compact('roles', 'id', 'userRoles'));
    }

    public function edit(User $id)
    {
        $roles = Role::all();
        $userRoles = $id->roles->pluck('id')->all();


        return view('users.edit', compact('roles', 'id', 'userRoles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'personnel_id' => 'required|unique:users',
//            'phone' => 'integer',
            'password' => 'required',
            'roles' => 'required'
        ], [
            'name.required' => 'لطفا نام و نام خانوادگی را وارد کنید.',
            'email.required' => 'لطفا کد ملی را وارد کنید.',
            'email.unique' => 'پرسنلی با این کد ملی در سیستم موجود است.',
//            'email.integer' => 'کد ملی باید از نوع عددی باشد.',
            'personnel_id.required' => 'لطفا شماره پرسنلی را وارد کنید.',
            'personnel_id.unique' => 'این شماره پرسنلی قبلا در سیستم ثبت شده است.',
//            'personnel_id.integer' => 'شماره پرسنلی باید از نوع عددی باشد.',
//            'phone.integer' => 'شماره تماس باید از نوع عددی باشد.',
            'password.required' => 'لطفا کلمه عبور را وارد کنید.',
            'roles.required' => 'لطفا یک بخش را انتخاب کنید.',
        ]);


        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $avatar = $request->file('avatar')->move("image/avatar", $name);
        } else {
            $avatar = null;
        }

        $input = $request->all();
        $input['avatar'] = $avatar;
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return ReturnMsgSuccess('مشخصات پرسنل با موفقیت ثبت شد');
    }

    public function show(Request $request)
    {
        $users = User::get();
        return view('users.show', compact('users'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
//            'email' => 'required|unique:users',
//            'personnel_id' => 'required|unique:users',
//            'phone' => 'integer',
            'roles' => 'required'
        ], [
            'name.required' => 'لطفا نام و نام خانوادگی را وارد کنید.',
//            'email.required' => 'لطفا کد ملی را وارد کنید.',
//            'email.unique' => 'پرسنلی با این کد ملی در سیستم موجود است.',
////            'email.integer' => 'کد ملی باید از نوع عددی باشد.',
//            'personnel_id.required' => 'لطفا شماره پرسنلی را وارد کنید.',
//            'personnel_id.unique' => 'این شماره پرسنلی قبلا در سیستم ثبت شده است.',
//            'personnel_id.integer' => 'شماره پرسنلی باید از نوع عددی باشد.',
//            'phone.integer' => 'شماره تماس باید از نوع عددی باشد.',
            'roles.required' => 'لطفا یک بخش را انتخاب کنید.',
        ]);
        $id = $request['id'];
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return ReturnMsgSuccess('مشخصات پرسنل با موفقیت ویرایش شد');
    }

    public function delete(User $id)
    {
        $id->delete();
        return ReturnMsgError('مشخصات پرسنل با موفقیت حذف شد');
    }

    public function profile()
    {
        return view('profile');

    }

    public function EditProfile(Request $request)
    {
        $id = auth()->user()->id;
        $users = User::where('id', $id)->get();
        foreach ($users as $user)
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $avatar = $request->file('avatar')->move("image/avatar", $name);
            } else {
                $avatar = $user->avatar;
            }
        User::find($user->id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'avatar' => $avatar,
        ]);
        return ReturnMsgSuccess('عملیات با موفقیت در سیستم ثبت شد');
    }

    public function EditPass(Request $request)
    {
        $input = $request->all();
        $user = User::find(auth()->user()->id);

        if (!Hash::check($input['oldpass'], $user->password)) {
            return ReturnMsgError('کلمه عبور قبلی صحیح نمیباشد');
        } else {
            User::find($user->id)->update([
                'password' => Hash::make($request['newpass']),
            ]);
            return ReturnMsgSuccess('کلمه عبور جدید در سیستم ثبت شد');
        }


    }
}
