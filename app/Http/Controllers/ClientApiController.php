<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Client;
use Carbon\Carbon;
use Illuminate\Database\QueryException;



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
                    array('name'=>$name, 'email'=>$email,'phone'=>$phone,'password'=>$password,'address'=>$address,'authentication_token'=>$authentication_token,'created_at'=>$created_at)
                );
                Client::insert($data);
                return response()->json([
                    'code'=>'0000',
                    'data'=>['authentication_token'=>$authentication_token]],201);
            }
            catch(QueryException $e){
                return response()->json([
                    'code'=>'9999',
                    'data'=>'duplicate entry'],400);
            }



        //$article = Client::create($request->all());



    }
    public function login(Request $request)
    {
        $user_input = null;
        //$h_phone =null;
        $user_input = $request->header('user_input');
        //$h_phone = $request->header('phone');
        $password = $request->header('password');
        //$password = $request->header('password');
        $authentication_token = $request->header('authentication_token');
        try{
            $phone = Client::select('password','authentication_token')
                ->where([['phone','=', $user_input]])
                ->first();
        }catch (QueryException $e){

        }
        try{
            $email = Client::select('password','authentication_token')
                ->where([['email','=', $user_input]])
                ->first();
        }catch (QueryException $e){

        }



        if(!$email == null){
            //getting phone and email from database
            $o_password = $email->password;
            $o_authentication_token = $email->authentication_token;
            //checking hash password and authentication token
            if (Hash::check( $password,$o_password) && $o_authentication_token==$authentication_token)
            {
                    //by crypting authentication token
                $authentication_token = bcrypt($authentication_token);
                    //updating authentication token
                $flag = Client::where([['email','=', $user_input]])->update(array('authentication_token' => $authentication_token));
                    // token is updated returning new token
                if($flag == 1){
                    return response()->json([
                        'code'=>'0000',
                        'data'=>$authentication_token],200);
                }
                // idf some reason token is not updating returning ol token
                elseif($flag == 0){
                    return response()->json([
                        'code'=>'0000',
                        'data'=>$o_authentication_token],200);
                }
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
            //checking hash password and authentication token
            if (Hash::check($password, $o_password) && $o_authentication_token == $authentication_token) {
                //by crypting authentication token
                $authentication_token = bcrypt($authentication_token);
                //updating authentication token
                $flag = Client::where([['phone', '=', $user_input]])->update(array('authentication_token' => $authentication_token));
                // token is updated returning new token
                if ($flag == 1) {
                    return response()->json([
                        'code' => '0000',
                        'data' => $authentication_token], 200);
                } // idf some reason token is not updating returning ol token
                elseif ($flag == 0) {
                    return response()->json([
                        'code' => '0000',
                        'data' => $o_authentication_token], 200);
                } //if some thing else happening return error report
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



        //taking password from query
//        foreach($login as $login){
//            $check = $login->password;
//            $authentication_token = $login->authentication_token;
//        }
//        if (Hash::check( $password,$check))
//        {
//            return response()->json([
//                'code'=>'0000',
//                'data'=>$authentication_token],200);
//        }else{
//            return response()->json([
//                'code'=>'9999',
//                'data'=>'error'],200);
//        }

    }



    public function update(Request $request, $id)
    {
        $article = Client::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Client::findOrFail($id);
        $article->delete();

        return 204;
    }
}
