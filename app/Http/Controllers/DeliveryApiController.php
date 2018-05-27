<?php

namespace App\Http\Controllers;
use App\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalController;



class DeliveryApiController extends Controller
{
    public function index()
    {

        $article = Delivery::select('receiverName','receiverPhone')->get();

        return response()->json([
            'code'=>'00000',
            'data'=>$article],201);
    }

    public function show($id)
    {

        $article = Delivery::find($id);
        return response()->json([
            'code'=>'00000',
            'data'=>$article],201);
    }
    public function transporter(Request $request)
    {
//        $tid = $request->header('tid');
        $article = Delivery::select('id','receiverName','receiverPhone','geoStartLatitude','geoStartLongitude','geoEndLatitude','geoEndLongitude','weight')->where([['deliveryTransporterId','=', 1],['ClientId','=',1]])->get();
        return response()->json([
            'code'=>'0000',
            'data'=>$article],200);
    }

    public function totalPrice(Request $request){
        $weight = $request->header('weight');
        $distance = $request->header('distance');

        $base =40;
        $totalCost = $base + ($weight * 10) + ($distance * 5);
        return response()->json([
            'code'=>'0000',
            'data'=>$totalCost],200);
    }
    public function DeliveryRequestConfirmed(Request $request){
        $cid = $request->header('cid');
        $geoStartLatitude = $request->header('geoStartLatitude');
        $geoStartLongitude = $request->header('geoStartLongitude');
        $geoEndLatitude = $request->header('geoEndLatitude');
        $geoEndLongitude  = $request->header('geoEndLongitude');
        $toLocation = $request->header('toLocation');
        $weight = $request->header('weight');
        $receiverPhone = $request->header('receiverPhone');
        $receiverName = $request->header('receiverName');
        $whoWillPay = $request->header('whoWillPay');
        $created_at = Carbon::now();


        $data = array(
            array('geoStartLatitude'=>$geoStartLatitude, 'cid'=>$cid,'geoStartLongitude'=>$geoStartLongitude,
                'geoEndLatitude'=>$geoEndLatitude,'geoEndLongitude'=>$geoEndLongitude,'toLocation'=>$toLocation,
                'weight'=>$weight,'receiverPhone'=>$receiverPhone,'receiverName'=>$receiverName,'whoWillPay'=>$whoWillPay,
                'created_at' => $created_at)
        );
        $flag = Transporter::insert($data);
    }

    public function store(Request $request)
    {

        $val = $request->header('id');
        $article = Delivery::create($request->all());


        return response()->json([
            'code'=>$val,
            'data'=>$article->title],201);
    }

    public function update(Request $request, $id)
    {
        $article = Delivery::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Delivery::findOrFail($id);
        $article->delete();

        return 204;
    }
}
