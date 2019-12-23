<?php

namespace Modules\Overtime\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Leave\Entities\Leave;
use Modules\Overtime\Entities\Overtime;
use Modules\TheRule\Entities\TheRule;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgInfo;
use function App\Providers\ReturnMsgSuccess;

class OvertimeController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('overtime::index', compact('users'));
    }

    public function wizard(User $id)
    {
        return view('overtime::wizard', compact('id'));

    }

    public function store(Request $request)
    {
        $querys = Overtime::where('user_id', $request['id'])
            ->whereNull('Admin')
            ->get();
        foreach ($querys as $query)
            if ($query) {
                return ReturnMsgInfo('یک درخواست اضافه کار فعال برای این پرسنل در سیستم موجود است');
            }
        $input = $request->all();
        $input['user_id'] = $request['id'];
        Overtime::create($input);
        return ReturnMsgSuccess('درخواست اضافه کار برای پرسنل با موفقیت ثبت شد');

    }

    public function show(Request $request)
    {

        $OverTimes = Overtime::whereNull('Archive')->orderBy('id', 'desc')->get();
        return view('overtime::show', compact('OverTimes'));
    }

    public function list(Request $request)
    {

        $OverTimes = Overtime::whereNotNull('Admin')->orderBy('id', 'desc')->get();
        return view('overtime::list', compact('OverTimes'));
    }

    public function admin(Request $request)
    {

        $OverTimes = Overtime::whereNull('Admin')->orderBy('id', 'desc')->get();

        return view('overtime::admin', compact('OverTimes'));
    }


    public function make(Request $request)
    {

        $OverTimes = Overtime::whereNotNull('Admin')->orderBy('id', 'desc')->get();
        return view('overtime::make', compact('OverTimes'));
    }


    public function success(Overtime $id)
    {
        $overtimes = Overtime::where('id', $id->id)->get();
        foreach ($overtimes as $overtime)
            Overtime::find($overtime->id)->update([
                'Admin' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست اضافه کار پرسنل موافقت شد');

    }


    public function error(Overtime $id)
    {
        $overtimes = Overtime::where('id', $id->id)->get();
        foreach ($overtimes as $overtime)
            Overtime::find($overtime->id)->update([
                'Admin' => 3,
            ]);
        return ReturnMsgSuccess('درخواست اضافه کار پرسنل رد شد');

    }

    public function check()
    {

        $checks = Overtime::whereNotNull('Admin')->where('Archive', null)->get();
        foreach ($checks as $check)
            Overtime::where('id', $check->id)->update([
                'Archive' => 1,
            ]);
        return ReturnMsgSuccess('درخواست ها بایگانی شدند');


    }


}
