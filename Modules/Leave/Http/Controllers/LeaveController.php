<?php

namespace Modules\Leave\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Leave\Entities\Leave;
use Modules\TheRule\Entities\TheRule;
use Modules\TheRule\Jobs\SendSmsErrorJob;
use Modules\TheRule\Jobs\SendSmsJob;
use Modules\TheRule\Jobs\SendSmsSuccessJob;
use MongoDB\BSON\Type;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgInfo;
use function App\Providers\ReturnMsgSuccess;

class LeaveController extends Controller
{

    public function index(Request $request)
    {
        $users = User::get();
        return view('leave::index', compact('users'));
    }

    public function wizard(User $user)
    {
        return view('leave::wizard', compact('user'));

    }

    public function edit(Leave $id)
    {

        $users = User::where('id', $id->user_id)->get();
        foreach ($users as $user)
            return view('leave::edit', compact('id', 'user'));

    }

    public function create()
    {
        return view('leave::create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'Type' => 'required',
        ], [
            'Type.required' => 'نوع مرخصی را انتخاب کنید',
        ]);


        $querys = Leave::where('user_id', $request['id'])->whereNull('Admin')
            ->get();
        foreach ($querys as $query)
            if ($query) {
                return ReturnMsgInfo('یک درخواست مرخصی فعال برای این پرسنل در سیستم موجود است');
            }

        if ($request['Type'] == 0) {
            return ReturnMsgError('لطفا نوع مرخصی را انتخاب کنید');
        } else
            if ($request['Type'] == 1) {
                $type = 'استحقاقی';
            } elseif ($request['Type'] == 2) {
                $type = 'استعلاجی';
            } else {
                $type = 'ساعتی';
            }
        if ($request['Type'] == 1 || $request['Type'] == 2) {
            $history = null;
        } else {
            $history = $request['history'];
        }
        if ($request['Type'] == 3) {
            $from = null;
            $todate = null;
        } else {
            $todate = $request['todate'];
            $from = $request['from'];
        }


        $input = $request->all();
        $input['user_id'] = $request['id'];
        $input['Type'] = $type;
        $input['history'] = $history;
        $input['from'] = $from;
        $input['todate'] = $todate;
        $leave = Leave::create($input);
        if ($leave) {
            if ($leave->Priority == 1) {
                $leave->update([
                    'Supervisor' => 3,
                ]);
                $user = User::where('id', $leave->user_id)->first();
                try {
                    \Modules\Leave\Jobs\SendSmsJob::dispatch($leave, $user);
                } catch (\Exception $exception) {

                }

            }

            return ReturnMsgSuccess('اطلاعات درخواست مرخصی با موفقیت در سیستم ثبت شد');
        }

    }

    public function show(Request $request)
    {

        $Leaves = Leave::whereNull('Archive')->orderBy('id', 'desc')->get();
        return view('leave::show', compact('Leaves'));
    }

    public function delete(Leave $id)
    {
        $delete = $id->delete();
        if ($delete) {
            return ReturnMsgError('اطلاعات مرخصی با موفقیت از سیستم حذف شد');

        }

    }

    public function update(Request $request)
    {

        if ($request['Type'] == 1) {
            $type = 'استحقاقی';
        } elseif ($request['Type'] == 2) {
            $type = 'استعلاجی';
        } else {
            $type = 'ساعتی';
        }

        if ($request['Type'] == 1 || $request['Type'] == 2) {
            $history = null;
        } else {
            $history = $request['history'];
        }
        if ($request['Type'] == 3) {
            $from = null;
            $todate = null;
        } else {
            $todate = $request['todate'];
            $from = $request['from'];
        }

        $leave = Leave::where('id', $request['id'])->first();
        $update = $leave->update([
            'Type' => $type,
            'history' => $history,
            'from' => $from,
            'todate' => $todate,
            'FromHour' => $request['FromHour'],
            'until' => $request['until'],
            'Priority' => $request['Priority'],
            'description' => $request['description'],
        ]);
        if ($update) {
            return ReturnMsgSuccess('اطلاعات درخواست مرخصی با موفقیت ویرایش شد');

        }


    }

    public function showleave(Request $request)
    {

        $Leaves = Leave::where('Supervisor', null)->orderBy('id', 'desc')->get();

        return view('leave::showleave', compact('Leaves'));
    }

    public function showadmin(Request $request)
    {

        $Leaves = Leave::whereNull('Admin')->where('Supervisor', 1)
            ->orwhere('Supervisor', 3)->whereNull('Admin')->orderBy('id', 'desc')->get();

        return view('leave::showadmin', compact('Leaves'));
    }

    public function supervisorTrue(Leave $id)
    {
        $ids = Leave::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $update = $ide->update([
                'Supervisor' => 1,
            ]);
        if ($update) {
            return ReturnMsgSuccess('با درخواست مرخصی پرسنل موافقت شد و برای تایید نهایی به مدیریت ارسال شد');

        }
    }

    public function supervisorFalse(Leave $id)
    {
        $ids = Leave::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $update = $ide->update([
                'Supervisor' => 2,
                'Admin' => 2,
            ]);
        if ($update) {
            $user = User::where('id', $ide->user_id)->first();
            \Modules\Leave\Jobs\SendSmsErrorJob::dispatch($ide, $user);
            return ReturnMsgError('با درخواست مرخصی پرسنل موافقت نشد نتیجه برای پرسنل پیامک میشود');
        }

    }

    public function adminTrue(Leave $id)
    {
        $ids = Leave::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $update = $ide->update([
                'Admin' => 1,
            ]);
        if ($update) {
            $user = User::where('id', $ide->user_id)->first();
            \Modules\Leave\Jobs\SendSmsSuccessJob::dispatch($ide, $user);

            return ReturnMsgSuccess('با درخواست مرخصی پرسنل موافقت شد نتیجه برای پرسنل پیامک میشود.');
        }

    }

    public function adminFalse(Leave $id)
    {
        $ids = Leave::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $update = $ide->update([
                'Admin' => 3,
            ]);
        if ($update) {
            $user = User::where('id', $ide->user_id)->first();
            \Modules\Leave\Jobs\SendSmsErrorJob::dispatch($ide, $user);
            return ReturnMsgError('با درخواست مرخصی پرسنل موافقت نشد نتیجه برای پرسنل پیامک میشود.');
        }

    }

    public function makeleave(Request $request)
    {

        $Leaves = Leave::where('Supervisor', 1)->orwhere('Supervisor', 2)->orderBy('id', 'desc')->get();

        return view('leave::makeleave', compact('Leaves'));
    }

    public function makeadmin(Request $request)
    {

        $Leaves = Leave::where('Admin', 1)->orwhere('Admin', 3)->orderBy('id', 'desc')->get();

        return view('leave::makeadmin', compact('Leaves'));
    }

    public function list(Leave $id, Request $request)
    {

        $users = Leave::where('user_id', $id->user_id)->orderBy('id', 'desc')->get();
        $user_id = User::all();


        return view('leave::list', compact('users', 'user_id', 'id'));


    }

    public function check()
    {

        $checks = Leave::whereNotNull('Admin')->where('Archive', null)->get();
        foreach ($checks as $check)
            $update = Leave::where('id', $check->id)->update([
                'Archive' => 1,
            ]);
        if ($update) {
            return ReturnMsgSuccess('درخواست ها بایگانی شدند');

        }


    }

    public function make(Request $request)
    {

        $Leaves = Leave::whereNotNull('Archive')->orderBy('id', 'desc')->get();
        return view('leave::make', compact('Leaves'));
    }

    public function save(Leave $id)
    {
        Leave::find($id->id)->update([
            'Archive' => 1,
        ]);
        return ReturnMsgSuccess('اطلاعات مرخصی پرسنل با موفقیت در سیستم بایگانی شد');

    }

}
