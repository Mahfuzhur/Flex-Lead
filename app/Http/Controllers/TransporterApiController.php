<?php

namespace App\Http\Controllers;
use App\Delivery;
use App\Transporter;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
class TransporterApiController extends Controller
{
    public function Registration(Request $request)
    {
        $name = $request->header('name');
        $email = $request->header('email');
        $phone = $request->header('phone');
        $nid = $request->header('nid');
        $dob = $request->header('dob');
        $pic = $request->header('pic');
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
                array('name'=>$name, 'email'=>$email,'phone'=>$phone,'nid'=>$nid,'dob'=>$dob,'pic'=>$pic,'address'=>$address,'password'=>$password,'authentication_token'=>$authentication_token,'created_at'=>$created_at,'status'=>$status)
            );
            $flag = Transporter::insert($data);
            if($flag){
                try{
                    $transporter = Transporter::select('id','authentication_token')
                        ->where([['nid','=',$nid]])
                        ->get();
                    return response()->json([
                        'code'=>'0000',
                        'data'=>$transporter],201);
                }
                catch (QueryException $e){


                }


            }
            else{
                return response()->json([
                    'code'=>'0000',
                    'data'=>'not found'],404);
            }

        }
        catch(QueryException $e){
//            return response()->json([
//                'code'=>'9999',
//                'data'=>'duplicate entry'],400);
            return $e;
        }
        //$article = Client::create($request->all());
    }

    public function login(Request $request)
    {
        $user_input = null;
        $user_input = $request->header('user_input');
        $password = $request->header('password');

        try{
            $phone = Transporter::select()
                ->where([['phone','=', $user_input]])
                ->first();
        }catch (QueryException $e){

        }
        try{
            $email = Transporter::select('password','authentication_token','id','name','phone','email','dob','address','nid','pic','dtId')
                ->where([['email','=', $user_input]])
                ->first();
        }catch (QueryException $e){

        }



        if(!$email == null){
            //getting phone and email from database
            $o_password = $email->password;
            $o_authentication_token = $email->authentication_token;
            //$o_id = $email->id;
            //checking hash password and authentication token
            if (Hash::check( $password,$o_password))
            {
                //by crypting authentication token
                $authentication_token = bcrypt($o_authentication_token);
                //updating authentication token
                $flag = Transporter::where([['email','=', $user_input]])->update(array('authentication_token' => $authentication_token));
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

            if (Hash::check($password, $o_password)) {
                //by crypting authentication token
                $authentication_token = bcrypt($o_authentication_token);
                //updating authentication token
                $flag = Transporter::where([['phone', '=', $user_input]])->update(array('authentication_token' => $authentication_token));
                // token is updated returning new token
                if ($flag == 1) {
                    return response()->json([
                        'code' => '0000',
                        'data' => $phone], 200);
                }
                // idf some reason token is not updating returning ol token
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

    public function serviceSearch(Request $request){
        $tId = $request->header('tId');
        $lat = $request->header('lat');
        $lon = $request->header('lon');
        //$service = $request->header('service');
        $flag = $request->header('serviceFlag');

        if ($flag == 0){
            $transporter = Transporter::find($tId);
            $transporter->geoLat = $lat;
            $transporter->geoLan = $lon;

            $transporter->save();
        }
        if ($flag == 1){
            $transporter = Transporter::find($tId);
            $transporter->geoLat = $lat;
            $transporter->geoLan = $lon;

            $transporter->save();

            $result = DB::table('service_request')
                ->select('id','Tid','Sid','tableId')
                ->where([['Tid','=',$tId]])
                ->first();
            if($result != null){
                $sId = $result->Sid;
                $cId = $result->id;
                $tableId = $result->tableId;
                $allId = DB::table('service_request')
                    ->select('id')
                    ->where([['Sid','=',$sId]])
                    ->get();
                foreach ($allId as $id){

                    if($cId>$id->id){
                        return response()->json(
                            [
                                'status' => 'bigger'
                            ],404
                        );

                    }
                    return response()->json(
                        [
                            'status' => 'found',
                            'id' => $cId,
                            'serviceId'=>$sId,
                            'tableId'=>$tableId
                        ],302
                    );
                }
            }
            elseif ($result == null){
                return response()->json(
                    [
                        'status'=>'no service'
                    ],404
                );
            }
        }

    }

    public function transporterServiceConfirmation(Request $request){

        $foundId = $request->header('foundId');
        $flag = $request->header('flag');
        // 1= accepted by
        if($flag == 1){
             $result = DB::table('service_request')->find($foundId);
             if($result != null){
                 $sId = $result-> Sid;
                 $tId = $result->Tid;
                 $tableId = $result->tableId;
                 //$result->delete();
                 DB::table('service_request')->where([['Sid','=',$sId]])->delete();
                 DB::table('service_request')->where([['Tid','=',$tId]])->delete();

                 $transporterStatusUpdate = Transporter::find($tId);
                 //1 = on service
                 $transporterStatusUpdate->status = 1;
                 $transporterStatusUpdate->save();

                 $deliveryTableUpdate = Delivery::find($sId);

                 $deliveryTableUpdate->deliveryTransporterId = $tId;
                 $deliveryTableUpdate->startTime = Carbon::now()->addHour(6);
                 $deliveryTableUpdate->save();
                 return response()->json([
                     'status'=>'success',
                     'data' => $deliveryTableUpdate
                 ],200
                 );
             }
             else{
                 return response()->json([
                     'status'=>'id not found'
                    ],404
                 );
             }

        }
        // 2= canceled
        elseif ($flag == 2){
            $result = DB::table('service_request')->find($foundId);
            $sId = $result-> Sid;
            $tId = $result->Tid;
            $tableId = $result->tableId;
            //$result->delete();
            DB::table('service_request')->where([['Tid','=',$tId],['Sid','=',$sId]])->delete();
            return response()->json(200
            );
        }
        elseif ($flag == 2){

        }
    }
}
