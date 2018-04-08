<?php

namespace App\Http\Controllers;
use App\Delivery;
use DB;
use Auth;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $delivery = DB::table('delivery')->get();
        return view('delivery.index', compact('delivery'));
    }
}
