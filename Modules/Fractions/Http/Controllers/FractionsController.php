<?php

namespace Modules\Fractions\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Fractions\Entities\Fractions;
use Modules\Leave\Entities\Leave;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgInfo;
use function App\Providers\ReturnMsgSuccess;

class FractionsController extends Controller
{
    public function index(Request $request)
    {
        $users = User::get();
        return view('fractions::index', compact('users'));
    }

    public function wizard(User $user)
    {
        return view('fractions::wizard', compact('user'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'Term' => 'required',
        ], [
            'Term.required' => 'لطفا مدت کسر کار را وارد کنید',
        ]);

        $querys = Fractions::where('user_id', $request['id'])->whereNull('Admin')->get();
        foreach ($querys as $query)
            if ($query) {
                return ReturnMsgInfo('یک درخواست کسر کار فعال برای این پرسنل در سیستم موجود است');
            }

        $input = $request->all();
        $input['user_id'] = $request['id'];
        $leave = Fractions::create($input);
//        if ($leave->Priority == 1) {
//            $leave->update([
//                'Supervisor' => 3,
//            ]);
////            $user = User::where('id', $leave->user_id)->first();
////            \Modules\Leave\Jobs\SendSmsJob::dispatch($leave, $user);
//        }

        return ReturnMsgSuccess('اطلاعات درخواست کسر کار با موفقیت در سیستم ثبت شد');
    }

    public function update(Request $request)
    {
        $fraction = Fractions::where('id', $request['id'])->first();
        $fraction->update([
            'history' => $request['history'],
            'Term' => $request['Term'],
            'type' => $request['type'],
            'Priority' => $request['Priority'],
            'description' => $request['description'],
        ]);
        return ReturnMsgSuccess('اطلاعات درخواست کسر کار با موفقیت ویرایش شد');


    }

    public function show(Request $request)
    {

        $Fractions = Fractions::whereNull('Archive')->orderBy('id', 'desc')->get();
        return view('fractions::show', compact('Fractions'));
    }

    public function make(Request $request)
    {

        $Fractions = Fractions::whereNotNull('Archive')->orderBy('id', 'desc')->get();
        return view('fractions::make', compact('Fractions'));
    }

    public function showfraction(Request $request)
    {

        $Fractions = Fractions::where('Supervisor', null)->orderBy('id', 'desc')->get();
        return view('fractions::showfraction', compact('Fractions'));
    }

    public function supervisorTrue(Fractions $id)
    {
        $ids = Fractions::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Supervisor' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست کسر کار پرسنل موافقت شد و برای تایید نهایی به مدیریت ارسال شد');
    }

    public function supervisorFalse(Fractions $id)
    {
        $ids = Fractions::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Supervisor' => 2,
                'Admin' => 2,
            ]);
        return ReturnMsgError('با درخواست کسر کار پرسنل موافقت نشد');
    }

    public function makefraction(Request $request)
    {

        $Fractions = Fractions::where('Supervisor', 1)->orwhere('Supervisor', 2)->orderBy('id', 'desc')->get();
        return view('fractions::makefraction', compact('Fractions'));
    }

    public function showadmin(Request $request)
    {

        $Fractions = Fractions::whereNull('Admin')->where('Supervisor', 1)
            ->orwhere('Supervisor', 3)->whereNull('Admin')->orderBy('id', 'desc')->get();
        return view('fractions::showadmin', compact('Fractions'));
    }

    public function adminTrue(Fractions $id)
    {
        $ids = Fractions::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Admin' => 1,
            ]);
//        $user = User::where('id', $ide->user_id)->first();
//        \Modules\Leave\Jobs\SendSmsSuccessJob::dispatch($ide, $user);

        return ReturnMsgSuccess('با درخواست کسر کار پرسنل موافقت شد');
    }

    public function adminFalse(Fractions $id)
    {
        $ids = Fractions::where('id', $id->id)->get();
        foreach ($ids as $ide)
            $ide->update([
                'Admin' => 3,
            ]);
//        $user = User::where('id', $ide->user_id)->first();
//        \Modules\Leave\Jobs\SendSmsErrorJob::dispatch($ide, $user);
        return ReturnMsgError('با درخواست کسر کار پرسنل موافقت نشد');
    }

    public function list(Fractions $id, Request $request)
    {

        $Fractions = Fractions::where('user_id', $id->user_id)->orderBy('id', 'desc')->get();
        $user_id = User::all();


        return view('fractions::list', compact('Fractions', 'user_id', 'id'));


    }

    public function makeadmin(Request $request)
    {

        $Fractions = Fractions::where('Admin', 1)->orwhere('Admin', 3)->orderBy('id', 'desc')->get();
        return view('fractions::makeadmin', compact('Fractions'));
    }

    public function delete(Fractions $id)
    {
        $id->delete();
        return ReturnMsgError('اطلاعات کسر کار با موفقیت حذف شد');

    }

    public function check()
    {

        $checks = Fractions::whereNotNull('Admin')->where('Archive', null)->get();
        foreach ($checks as $check)
            Fractions::where('id', $check->id)->update([
                'Archive' => 1,
            ]);
        return ReturnMsgSuccess('درخواست ها بایگانی شدند');


    }

    public function edit(Fractions $id)
    {

        $users = User::where('id', $id->user_id)->get();
        foreach ($users as $user)
            return view('fractions::edit', compact('id', 'user'));

    }
    public function save(Fractions $id)
    {
        Fractions::find($id->id)->update([
            'Archive' => 1,
        ]);
        return ReturnMsgSuccess('اطلاعات کسر کار پرسنل با موفقیت در سیستم بایگانی شد');

    }


}
