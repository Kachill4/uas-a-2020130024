<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Models\order;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $allmenu = menu::all()->count();
        $allorder = order::all()->count();
        return view('index',compact('allmenu','allorder'));
    }
}
