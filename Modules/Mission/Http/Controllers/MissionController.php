<?php

namespace Modules\Mission\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Leave\Entities\Leave;
use Modules\Mission\Entities\Mission;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;

class MissionController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('mission::index', compact('users'));
    }

    public function wizard(User $id)
    {
        return view('mission::wizard', compact('id'));

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = $request->id;

        Mission::create($input);
        return ReturnMsgSuccess('ماموریت با موفقیت در سیستم ثبت شد');

    }

    public function list(Request $request)
    {

        $Missions = Mission::whereNull('Archive')->get();
        return view('mission::list', compact('Missions'));
    }

    public function stores(Request $request)
    {

        $Missions = Mission::whereNotNull('Archive')->get();
        return view('mission::store', compact('Missions'));
    }

    public function shows(Request $request)
    {

        $Missions = Mission::whereNull('Supervisor')->get();
        return view('mission::shows', compact('Missions'));
    }

    public function supersuccess(Mission $id)
    {
        Mission::find($id->id)->update([
            'Supervisor' => 1,
        ]);
        return ReturnMsgSuccess('با درخواست ماموریت موافقت شد');

    }

    public function supererror(Mission $id)
    {
        Mission::find($id->id)->update([
            'Supervisor' => 2,
            'Admin' => 2,
        ]);
        return ReturnMsgError('درخواست ماموریت پرسنل رد شد');

    }

    public function makes(Request $request)
    {
        $Missions = Mission::whereNotNull('Supervisor')->get();
        return view('mission::makes', compact('Missions'));
    }

    public function showadmin(Request $request)
    {

        $Missions = Mission::whereNull('Admin')->where('Supervisor', 1)->get();
        return view('mission::showadmin', compact('Missions'));
    }

    public function adminsuccess(Mission $id)
    {
        Mission::find($id->id)->update([
            'Admin' => 1,
        ]);
        return ReturnMsgSuccess('با درخواست ماموریت موافقت شد');

    }

    public function adminerror(Mission $id)
    {
        Mission::find($id->id)->update([
            'Admin' => 3,
        ]);
        return ReturnMsgError('درخواست ماموریت پرسنل رد شد');

    }

    public function makeadmin(Request $request)
    {

        $Missions = Mission::whereNotNull('Admin')->get();
        return view('mission::makeadmin', compact('Missions'));
    }

    public function edit(Mission $id)
    {
        return view('mission::edit', compact('id'));

    }

    public function delete(Mission $id)
    {
        $id->delete();
        return ReturnMsgError('مشخصات ماموریت با موفقیت حذف شد');


    }

    public function update(Request $request)
    {
        Mission::find($request->id)->update([
            'location' => $request['location'],
            'from' => $request['from'],
            'fromtime' => $request['fromtime'],
            'to' => $request['to'],
            'totime' => $request['totime'],
            'summary' => $request['summary'],
            'description' => $request['description'],
        ]);
        return ReturnMsgSuccess('مشخصات ماموریت با موفقیت ویرایش شد');
    }

}
