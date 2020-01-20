<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemittancesController extends Controller
{
    public function index()
    {
        return view('store.Remittances.index');

    }
}
