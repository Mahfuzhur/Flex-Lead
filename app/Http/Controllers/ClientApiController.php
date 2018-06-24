<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Client;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use App\Transporter;
use DB;
use App\Delivery;


class ClientApiController extends Controller
{
    public function index()
    {

        $article = Client::select('name','phone')->get();

        return response()->json([
            'code'=>'00000',
            'data'=>$article],201);
    }

    public function show($id)
    {

        $article = Client::find($id);
        return response()->json([
            'code'=>'00000',
            'data'=>$article],201);
    }
    public function transporter(Request $request)
    {
//        $tid = $request->header('tid');
        $article = Client::select('id','receiverName','receiverPhone','geoStartLatitude','geoStartLongitude','geoEndLatitude','geoEndLongitude','weight')->where('deliveryTransporterId', 1)->get();
        return response()->json([
            'code'=>'0000',
            'data'=>$article],200);
    }

    public function Registration(Request $request)
    {
        $name = $request->header('name');
        $email = $request->header('email');
        $phone = $request->header('phone');
         //$check = $request->header('password');
        $password = bcrypt($request->header('password'));
        $address = $request->header('address');
        $authentication_token = bcrypt($password);
        $created_at = Carbon::now();
        $status = 0;
         //$hpass = bcrypt($password);
//        if (Hash::check($check, $password))
//        {
//            $flag=0;
//        }
//        try{
//            $o_email = Client::findOrFail($email);
//            $o_phone = Client::findOrFail($phone);
//            return response()->json([
//                'code'=>$o_email,
//                'data'=>$o_phone],201);
//        }catch (QueryException $e){
//            return response()->json([
//                'code'=>$o_email,
//                'data'=>$o_phone],400);
//        }

            try{
                $data = array(
                    array('name'=>$name, 'email'=>$email,'phone'=>$phone,'password'=>$password,'address'=>$address,'authentication_token'=>$authentication_token,'created_at'=>$created_at,'status'=>$status)
                );

                 $flag = Client::insert($data);
                if($flag){
                    $client = Client::select('id','authentication_token')
                        ->where([['phone','=',$phone]])
                        ->get();
                    return response()->json([
                        'code'=>'0000',
                        'data'=>$client],201);

                }else{
                    return response()->json([
                        'code'=>'0000',
                        'data'=>'not found'],404);
                }

            }
            catch(QueryException $e){
//                return response()->json([
//                    'code'=>'9999',
//                    'data'=>'duplicate entry'],400);
                return $e;
            }

    }
    public function login(Request $request)
    {
        $user_input = null;
        //$h_phone =null;
        $user_input = $request->header('user_input');
        //$h_phone = $request->header('phone');
        $password = $request->header('password');
        //$password = $request->header('password');
        //$authentication_token = $request->header('authentication_token');
        try{
            $phone = Client::select('password','authentication_token','id','name','phone','email','address')
                ->where([['phone','=', $user_input]])
                ->first();
        }catch (QueryException $e){

        }
        try{
            $email = Client::select('password','authentication_token','id','name','phone','email','address')
                ->where([['email','=', $user_input]])
                ->first();
        }catch (QueryException $e){

        }



        if(!$email == null){
            //getting phone and email from database
            $o_password = $email->password;
            $o_authentication_token = $email->authentication_token;
            $o_id = $email->id;
            //checking hash password and authentication token
            if (Hash::check( $password,$o_password))
            {
                    //by crypting authentication token
                $authentication_token = bcrypt($o_authentication_token);
                    //updating authentication token
                $flag = Client::where([['email','=', $user_input]])->update(array('authentication_token' => $authentication_token));
                    // token is updated returning new token
                if($flag == 1){
                    return response()->json([
                        'code'=>'0000',
                        'data'=>$email],200);
                }
                // idf some reason token is not updating returning ol token
//                elseif($flag == 0){
//                    return response()->json([
//                        'code'=>'0000',
//                        'data'=>$o_authentication_token],200);
//                }
                //if some thing else happening return error report
                else{
                    return response()->json([
                        'code'=>'9999',
                        'data'=>'error'],404);
                }

            }
        }
        elseif(!$phone == null) {
            //getting phone and email from database
            $o_password = $phone->password;
            $o_authentication_token = $phone->authentication_token;
            $o_id = $phone->id;
            //checking hash password and authentication token
            if (Hash::check($password, $o_password)) {
                //by crypting authentication token
                $authentication_token = bcrypt($o_authentication_token);
                //updating authentication token
                $flag = Client::where([['phone', '=', $user_input]])->update(array('authentication_token' => $authentication_token));
                // token is updated returning new token
                if ($flag == 1) {
                    return response()->json([
                        'code' => '0000',
                        'data' => $phone], 200);
                } // idf some reason token is not updating returning ol token
//                elseif ($flag == 0) {
//                    return response()->json([
//                        'code' => '0000',
//                        'data' => $o_authentication_token], 200);
//                }
//              //if some thing else happening return error report
                else {
                    return response()->json([
                        'code' => '9999',
                        'data' => 'error'], 404);
                }
            }
            else{
                return response()->json([
                    'code' => '9999',
                    'data' => 'error'], 404);
            }
        }

    }



    public function update(Request $request)
    {
        $name = $request->header('name');
        $email = $request->header('email');
        $phone = $request->header('phone');
        $password = $request->header('password');
        $address = $request->header('address');
        $id = $request->header('id');
        $user = Client::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->password = bcrypt($password);
        $user->address = $address;

        $flag = $user->save();
        if($flag){
            return response()->json([

                'data' => 'updated'], 200);
        }else{
            return response()->json([

                'data' => 'not found'], 204);
        }

    }
    public function transporterSearch(Request $request)
    {

        $lat = $request->header('geoStartLatitude');
        $lng = $request->header('geoStartLongitude');
        $endLat = $request->header('geoEndLatitude');
        $endLng = $request->header('geoEndLongitude');
        $weight = $request->header('weight');
        $receiverName = $request->header('receiverName');
        $receiverPhone = $request->header('receiverPhone');
        $clientId = $request->header('clientId');
        $payPerson = $request->header('payPerson');
        $TotalPrice = $request->header('TotalPrice');
        $createdAt = Carbon::now();
        $distance = 1;
        $id = Delivery::insertGetId(['clientId'=>$clientId,'receiverName'=>$receiverName,
            'receiverPhone'=>$receiverPhone,'geoStartLatitude'=>$lat,
            'geoStartLongitude'=>$endLng,'geoEndLatitude'=>$endLat,
            'geoEndLongitude'=>$endLng,'weight'=>$weight,'totalPrice'=>$TotalPrice,
            'payPerson'=>$payPerson,'created_at'=>$createdAt]);


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
            //array_push($ids, $q->id);
            $tid = $q->id;
            DB::table('service_request')->insert(['Tid'=>$tid,'Sid'=>$id]);

        }

        // Get the listings that match the returned ids
        //$results = DB::table('transporter')->whereIn( 'id', $ids)->orderBy('geoLan', 'ASC')->paginate(9999);

        //$articles = $results;

//        return view('articles.index', compact('categories'))->withArticles($articles);
//        $tid = 8;
//        while($tid != null){
//            $tid = Delivery::select('deliveryTransporterId')->where([['id','=',12]])->get();
//        }

        return response()->json([
            'Delivery Id'=>$id],201);

    }

    public function serviceResponse(Request $request){
        $did = $request->header('did');
        $tid = Delivery::select('deliveryTransporterId','status')->where([['id','=',$did]])->first();
        $t_id = $tid->deliveryTransporterId;
        $status = $tid->status;
        if($status == 'found'){
            $transporter = Transporter::join
                ('delivarytransporter', 'delivarytransporter.transporterId', '=','transporter.id' )
                ->select('transporter.*', 'delivarytransporter.id')
                ->where([['transporter.id','=' ,1]])
                //
                ->get();
            return response()->json([
                'status' => 'found',
                'transporter'=>$transporter],302);
        }
        elseif ($status = 'not found'){
            return response()->json([
                'status' => 'not found'],404);
        }
        elseif ($status = 'canceled'){
            return response()->json([
                'status' => 'canceled'],201);
        }

    }

    public function delete(Request $request, $id)
    {
        $article = Client::findOrFail($id);
        $article->delete();

        return 204;
    }
}
