<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use function App\Providers\ReturnMsgSuccess;

class StoreController extends Controller
{
    public function index()
    {
        return view('store.exitstore.index');

    }

    public function store(Request $request)
    {
        Store::create($request->all());
        return ReturnMsgSuccess('مشخصات خروج کالا در سیستم ثبت شد');

    }

    public function list()
    {
        $stores = Store::all();
        return view('store.exitstore.list', compact('stores'));

    }
}
