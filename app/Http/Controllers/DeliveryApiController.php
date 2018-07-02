<?php

namespace App\Http\Controllers;
use App\Delivery;
use App\Transporter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalController;
use DB;



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
        $article = Delivery::select('id','receiverName','receiverPhone','geoStartLatitude',
            'geoStartLongitude','geoEndLatitude','geoEndLongitude','weight')
            ->where([['deliveryTransporterId','=', 1],['ClientId','=',1]])->get();
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
    public function distance(Request $request) {
        //$lat1, $lon1, $lat2, $lon2, $unit
        $lat1 = $request->header('lat1');
        $lon1 = $request->header('lon1');
        $lat2 = $request->header('lat2');
        $lon2 = $request->header('lon2');
        $unit = $request->header('unit');

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return response()->json([
                'code'=>'0000',
                'data'=>($miles * 1.609344)],200);
            //return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    public function transporterSearch(Request $request)
    {
        $lat = $request->header('lat');
        $lng = $request->header('lng');
        $distance = 1;

        $query = Transporter::getByDistance($lat, $lng, $distance);

        if(empty($query)) {
            return response()->json([
                'code'=>'9999',
                'data'=>'empty' ],200);
        }

        $ids = [];

        //Extract the id's
        foreach($query as $q)
        {
            array_push($ids, $q->id);
        }

        // Get the listings that match the returned ids
        $results = DB::table('transporter')->whereIn( 'id', $ids)->orderBy('geoLan', 'ASC')->paginate(9999);

        $articles = $results;

//        return view('articles.index', compact('categories'))->withArticles($articles);
        return response()->json([
            'code'=>'0000',
            'data'=>$ids],200);

    }

}
