<?php

namespace App\Http\Controllers;
use App\Delivery;
use DB;
use Auth;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $deliveries = DB::table('delivery')->get();
        return view('delivery.index', compact('deliveries'));
    }
}
