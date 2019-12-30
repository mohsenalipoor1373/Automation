<?php

namespace Modules\TheRule\Http\Controllers;

use App\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\TheRule\Entities\TheRule;
use Modules\TheRule\Jobs\SendSmsErrorJob;
use Modules\TheRule\Jobs\SendSmsJob;
use Modules\TheRule\Jobs\SendSmsSuccessJob;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgInfo;
use function App\Providers\ReturnMsgSuccess;


class TheRuleController extends Controller
{


    public function index(Request $request)
    {
        $users = User::get();
        return view('therule::index', compact('users'));
    }

    public function wizard(User $id)
    {
        return view('therule::wizard', compact('id'));
    }

    public function edit(TheRule $id)
    {
        $users = User::where('id', $id->user_id)->get();
        foreach ($users as $user)

            return view('therule::edit', compact('id', 'user'));

    }

    public function store(Request $request)
    {


        $request->validate([
            'price' => 'required',
        ], [
            'price.required' => 'لطفا مبلغ را وارد کنید',
        ]);

        $querys = TheRule::where('user_id', $request['id'])->where('Admin', null)
            ->get();
        foreach ($querys as $query)
            if ($query) {
                return ReturnMsgInfo('یک درخواست مساعده فعال برای این پرسنل در سیستم موجود است');
            }
        $input = $request->all();
        $input['user_id'] = $request['id'];
        $theRule = TheRule::create($input);
        if ($theRule->Priority == 1) {
            $theRule->update([
                'Supervisor' => 3,
            ]);
            $user = User::where('id', $theRule->user_id)->first();
            try {
                SendSmsJob::dispatch($theRule, $user);
            } catch (\Exception $exception){

            }

        }

        if ($theRule) {
            return ReturnMsgSuccess('درخواست مساعده با موفقیت در سیستم ثبت شد');

        }


    }


    public function show(Request $request)
    {

        $TheRules = TheRule::where('Archive', null)->orderBy('id', 'desc')->get();
        return view('therule::show', compact('TheRules'));
    }

    public function delete(TheRule $id)
    {
        $success = $id->delete();
        if ($success) {
            return ReturnMsgError('اطلاعات درخواست مساعده با موفقیت از سیستم حذف شد');
        }

    }

    public function update(Request $request)
    {
        $update = TheRule::find($request['id'])->update([
            'price' => $request['price'],
            'Priority' => $request['Priority'],
            'description' => $request['description'],
        ]);
        if ($update) {
            return ReturnMsgSuccess('اطلاعات درخواست مساعده با موفقیت ویرایش شد');
        }


    }

    public function make(Request $request)
    {

        $TheRules = TheRule::where('Archive', '!=', "")->orderBy('id', 'desc')->get();

        return view('therule::make', compact('TheRules'));
    }

    public function supervisorlist(Request $request, TheRule $id)
    {

        $TheRules = TheRule::where('user_id', $id->user_id)->orderBy('id', 'desc')->get();
        $user_id = User::all();
        return view('therule::list', compact('TheRules', 'user_id'));
    }

    public function showrule(Request $request)
    {

        $TheRules = TheRule::where('Supervisor', null)->orderBy('id', 'desc')->get();

        return view('therule::showrule', compact('TheRules'));
    }

    public function supervisorTrue(TheRule $id)
    {
        $ids = TheRule::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $update = $ide->update([
                'Supervisor' => 1,
            ]);
        if ($update) {
            return ReturnMsgSuccess('با درخواست مساعده پرسنل موافقت شد و برای تایید نهایی به مدیریت ارسال شد.');

        }
    }

    public function supervisorFalse(TheRule $id)
    {
        $ids = TheRule::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $update = $ide->update([
                'Supervisor' => 2,
                'Admin' => 2,
            ]);
        if ($update) {
            $user = User::where('id', $ide->user_id)->first();
            SendSmsErrorJob::dispatch($ide, $user);
            return ReturnMsgError('با درخواست مساعده پرسنل موافقت نشد نتیجه برای پرسنل پیامک میشود.');
        }

    }

    public function makerule(Request $request)
    {

        $TheRules = TheRule::where('Supervisor', 1)->orwhere('Supervisor', 2)->orderBy('id', 'desc')->get();

        return view('therule::makerule', compact('TheRules'));
    }

    public function showadmin(Request $request)
    {

        $TheRules = TheRule::where('Admin', null)->where('Supervisor', 1)
            ->orwhere('Supervisor', 3)->orderBy('id', 'desc')->get();
        return view('therule::showadmin', compact('TheRules'));
    }

    public function adminTrue(TheRule $id)
    {
        $ids = TheRule::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $update = $ide->update([
                'Admin' => 1,
            ]);
        if ($update) {
            $user = User::where('id', $ide->user_id)->first();
            SendSmsSuccessJob::dispatch($ide, $user);
            return ReturnMsgSuccess('با درخواست مساعده پرسنل موافقت شد نتیجه برای پرسنل پیامک میشود.');
        }

    }

    public function adminFalse(TheRule $id)
    {
        $ids = TheRule::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $update = $ide->update([
                'Admin' => 3,
            ]);
        if ($update) {
            $user = User::where('id', $ide->user_id)->first();
            SendSmsErrorJob::dispatch($ide, $user);
            return ReturnMsgError('با درخواست مساعده پرسنل موافقت نشد نتیجه برای پرسنل پیامک میشود.');
        }

    }

    public function makeadmin(Request $request)
    {

        $TheRules = TheRule::where('Admin', 1)->orwhere('Admin', 3)->orderBy('id', 'desc')->get();
        return view('therule::makeadmin', compact('TheRules'));
    }

    public function check()
    {

        $checks = TheRule::whereNotNull('Admin')->where('Archive', null)->get();
        foreach ($checks as $check)
            $update = TheRule::where('id', $check->id)->update([
                'Archive' => 1,
            ]);
        if ($update) {
            return ReturnMsgSuccess('درخواست ها بایگانی شدند');

        }


    }

    public function save(TheRule $id)
    {
        TheRule::find($id->id)->update([
            'Archive' => 1,
        ]);
        return ReturnMsgSuccess('اطلاعات مساعده با موفقیت در سیستم بایگانی شد');

    }

}
