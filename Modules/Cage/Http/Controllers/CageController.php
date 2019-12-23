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
        return ReturnMsgSuccess('مشخصات خرید کالا با موفقیت در سیستم ثبت شد');

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
        return ReturnMsgSuccess('تاریخ با موفقیت برای این درخواست ثبت شد');
    }

    public function success(Cage $id)
    {
        $cages = Cage::where('id', $id->id)->get();
        foreach ($cages as $cage)
            Cage::find($cage->id)->update([
                'buy' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست تولید موافقت شد');

    }

    public function error(Cage $id)
    {
        $cages = Cage::where('id', $id->id)->get();
        foreach ($cages as $cage)
            Cage::find($cage->id)->update([
                'buy' => 2,
            ]);
        return ReturnMsgSuccess('درخواست تولید رد شد');

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



}
