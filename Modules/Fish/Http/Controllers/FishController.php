<?php

namespace Modules\Fish\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cage\Entities\Cage;
use Modules\Fish\Entities\Fish;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgSuccess;

class FishController extends Controller
{

    public function index()
    {
        return view('fish::index');
    }

    public function store(Request $request)
    {
        Fish::create($request->all());

        return ReturnMsgSuccess('درخواست شما با موفقیت ارسال شد');

    }

    public function list(Request $request)
    {
        $Fishs = Fish::whereNull('Archive')->get();

        return view('fish::list', compact('Fishs'));

    }

    public function details()
    {
        $Fishs = Fish::whereNotNull('Archive')->get();

        return view('fish::details', compact('Fishs'));
    }

    public function make()
    {
        $Fishs = Fish::whereNull('buy')->get();

        return view('fish::make', compact('Fishs'));

    }

    public function datestore(Request $request)
    {
        $cages = Fish::where('id', $request->id)->get();
        foreach ($cages as $cage)
            Fish::find($cage->id)->update([
                'date' => $request['date'],
            ]);
        return ReturnMsgSuccess('تاریخ با موفقیت برای این درخواست ثبت شد');
    }

    public function showdate(Fish $id)
    {
        return view('fish::date', compact('id'));

    }

    public function makea()
    {

        $Fishs = Fish::whereNotNull('buy')->get();

        return view('fish::makeadmin', compact('Fishs'));
    }

    public function success(Fish $id)
    {
        $cages = Fish::where('id', $id->id)->get();
        foreach ($cages as $cage)
            Fish::find($cage->id)->update([
                'buy' => 1,
            ]);
        return ReturnMsgSuccess('با درخواست تولید موافقت شد');

    }

    public function error(Fish $id)
    {
        $cages = Fish::where('id', $id->id)->get();
        foreach ($cages as $cage)
            Fish::find($cage->id)->update([
                'buy' => 2,
            ]);
        return ReturnMsgSuccess('درخواست تولید رد شد');

    }



}
