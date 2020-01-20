<?php

namespace App\Http\Controllers;

use App\Goods;
use Illuminate\Http\Request;
use function App\Providers\ReturnMsgSuccess;

class GoodsController extends Controller
{
    public function index()
    {
        return view('store.Goods.index');

    }

    public function store(Request $request)
    {
        Goods::create($request->all());
        return ReturnMsgSuccess('مشخصات رسید کالا در سیستم ثبت شد');

    }

    public function list()
    {
        $goods = Goods::all();
        return view('store.Goods.list', compact('goods'));

    }
}
