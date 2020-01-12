<?php

namespace Modules\Cage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Buy\Entities\Buy;
use Modules\Cage\Entities\Cage;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;

class CageController extends Controller
{

    public function index()
    {
        return view('cage::index');
    }

    public function store(Request $request)
    {
        Cage::create($request->all());
        return ReturnMsgSuccess('اطلاعات تولید تورقفس با موفقیت در سیستم ثبت شد');

    }

    public function list(Request $request)
    {
        $Cages = Cage::whereNull('Archive')->get();
        return view('cage::list', compact('Cages'));

    }

    public function showadmin(Request $request)
    {
        $Cages = Cage::whereNull('buy')->get();

        return view('cage::showadmin', compact('Cages'));

    }

    public function date(Cage $id)
    {
        return view('cage::date', compact('id'));

    }

    public function datestore(Request $request)
    {
        $cages = Cage::where('id', $request->id)->get();
        foreach ($cages as $cage)
            Cage::find($cage->id)->update([
                'date' => $request['date'],
            ]);
        return ReturnMsgSuccess('تعیین تاریخ برای تولید تورقفس  با موفقیت در سیستم ثبت شد');
    }

    public function success(Cage $id)
    {
        $cages = Cage::where('id', $id->id)->get();
        foreach ($cages as $cage)
            Cage::find($cage->id)->update([
                'buy' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست تولید تورقفس  موافقت شد');

    }

    public function error(Cage $id)
    {
        $cages = Cage::where('id', $id->id)->get();
        foreach ($cages as $cage)
            Cage::find($cage->id)->update([
                'buy' => 2,
            ]);
        return ReturnMsgSuccess('درخواست تولید تورقفس  رد شد');

    }

    public function make(Request $request)
    {
        $Cages = Cage::whereNotNull('Archive')->get();

        return view('cage::make', compact('Cages'));

    }

    public function makeadmin(Request $request)
    {

        $Cages = Cage::whereNotNull('buy')->get();

        return view('cage::make', compact('Cages'));

    }

    public function save(Cage $id)
    {
        Cage::find($id->id)->update([
            'Archive' => 1,
        ]);
        return ReturnMsgSuccess('اطلاعات تولید تورقفس  با موفقیت در سیستم بایگانی شد');

    }

    public function edit(Cage $id)
    {
        return view('cage::edit', compact('id'));

    }

    public function delete(Cage $id)
    {
        $id->delete();
        return ReturnMsgError('اطلاعات تولید تورقفس  با موفقیت از سیستم حذف شد');

    }

    public function update(Request $request)
    {
        $update = Cage::find($request['id'])->update($request->all());
        if ($update) {
            return ReturnMsgSuccess('اطلاعات تولید تورقفس  با موفقیت ویرایش شد');
        }
    }

    public function cagem(Cage $id)
    {
        Cage::find($id->id)->update([
            'fina' => 1,
        ]);
        return ReturnMsgSuccess('با درخواست تولید موافقت شد');

    }


    public function cagemv()
    {
        $Cages = Cage::whereNull('fina')->get();
        return view('cage::cagem', compact('Cages'));

    }

    public function cageoff(Cage $id)
    {
        Cage::find($id->id)->update([
            'off' => 1,
        ]);
        return ReturnMsgSuccess('درخواست برای تولید ارسال شد');

    }

    public function cagemm()
    {
        $Cages = Cage::whereNull('final')->whereNotNull('buy')->get();
        return view('cage::cagemm', compact('Cages'));

    }

    public function cagemmd(Cage $id)
    {
        Cage::find($id->id)->update([
            'final' => 1,
        ]);
        return ReturnMsgSuccess('درخواست تپلید تور قفس تایید شد');

    }
}
