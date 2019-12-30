<?php

namespace Modules\Fish\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cage\Entities\Cage;
use Modules\Fish\Entities\Fish;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
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

        return ReturnMsgSuccess('اطلاعات درخواست تولید تور صیدماهی با موفقیت در سیستم ثبت شد');

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
        $Fishs = Fish::whereNull('buy')->whereNotNull('fina')->get();

        return view('fish::make', compact('Fishs'));

    }



    public function makes()
    {
        $Fishs = Fish::whereNull('fina')->get();

        return view('fish::makes', compact('Fishs'));

    }


    public function datestore(Request $request)
    {
        $cages = Fish::where('id', $request->id)->get();
        foreach ($cages as $cage)
            Fish::find($cage->id)->update([
                'date' => $request['date'],
            ]);
        return ReturnMsgSuccess('تعیین تاریخ با موفقیت برای این تور صید ماهی در سیستم ثبت شد');
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
        return ReturnMsgSuccess('با درخواست تولید تور صیدماهی موافقت شد');

    }

    public function error(Fish $id)
    {
        $cages = Fish::where('id', $id->id)->get();
        foreach ($cages as $cage)
            Fish::find($cage->id)->update([
                'buy' => 2,
            ]);
        return ReturnMsgSuccess('با درخواست تولید تور صیدماهی موافقت نشد');

    }

    public function save(Fish $id)
    {
        Fish::find($id->id)->update([
            'Archive' => 1,
        ]);
        return ReturnMsgSuccess('اطلاعات تورصیدماهی با موفقیت در سیستم بایگانی شد');

    }
    public function edit(Fish $id)
    {
        return view('fish::edit', compact('id'));

    }

    public function delete(Fish $id)
    {
        $id->delete();
        return ReturnMsgError('اطلاعات تولید تورصیدماهی با موفقیت از سیستم حذف شد');

    }
    public function update(Request $request)
    {
        $update = Fish::find($request['id'])->update($request->all());
        if ($update) {
            return ReturnMsgSuccess('اطلاعات تولید تورصیدماهی با موفقیت ویرایش شد');
        }
    }


}
