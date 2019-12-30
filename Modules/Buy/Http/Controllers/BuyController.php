<?php

namespace Modules\Buy\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Buy\Entities\Buy;
use Modules\Mission\Entities\Mission;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;

class BuyController extends Controller
{

    public function index()
    {
        $roles = Role::get();
        return view('buy::index', compact('roles'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Buy::create($input);
        return ReturnMsgSuccess('درخواست خرید با موفقیت در سیستم ثبت شد');
    }

    public function list(Request $request)
    {

        $Buys = Buy::whereNull('Archive')->get();
        return view('buy::list', compact('Buys'));
    }

    public function shows(Request $request)
    {
        $Buys = Buy::whereNull('Supervisor')->get();
        return view('buy::shows', compact('Buys'));
    }

    public function supers(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'Supervisor' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست خرید موافقت شد');
    }

    public function errors(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'Supervisor' => 2,
                'Admin' => 2,
            ]);
        return ReturnMsgError('درخواست خرید رد شد');
    }

    public function make(Request $request)
    {

        $Buys = Buy::whereNotNull('Supervisor')->get();
        return view('buy::make', compact('Buys'));
    }

    public function showadmin(Request $request)
    {
        $Buys = Buy::whereNull('Admin')->whereNotNull('Supervisor')->get();
        return view('buy::showadmin', compact('Buys'));
    }

    public function admins(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'Admin' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست خرید موافقت شد');
    }

    public function admine(Buy $id)
    {
        $buys = Buy::where('id', $id->id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'Admin' => 3,
            ]);
        return ReturnMsgError('درخواست خرید رد شد');
    }

    public function makeadmin(Request $request)
    {
        $Buys = Buy::whereNotNull('Admin')->get();
        return view('buy::makeadmin', compact('Buys'));
    }

    public function stores()
    {
        $Buys = Buy::whereNotNull('Archive')->get();
        return view('buy::stores', compact('Buys'));

    }

    public function save(Buy $id)
    {
        Buy::find($id->id)->update([
            'Archive' => 1,
        ]);
        return ReturnMsgSuccess('اطلاعات درخواست خرید با موفقیت در سیستم بایگانی شد');

    }

    public function delete(Buy $id)
    {
        $id->delete();
        return ReturnMsgError('اطلاعات درخواست خرید با موفقیت از سیستم حذف شد');

    }

    public function edit(Buy $id)
    {
        $roles = Role::get();
        return view('buy::edit', compact('id', 'roles'));

    }

    public function update(Request $request)
    {
        $update = Buy::find($request['id'])->update([
           'name'=>$request['name'],
           'role_id'=>$request['role_id'],
           'number'=>$request['number'],
           'store'=>$request['store'],
           'Priority'=>$request['Priority'],
           'description'=>$request['description'],
        ]);
        if ($update) {
            return ReturnMsgSuccess('اطلاعات درخواست خرید با موفقیت ویرایش شد');
        }

    }



}
