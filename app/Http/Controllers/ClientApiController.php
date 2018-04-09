<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Client;
use Carbon\Carbon;
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
        $remember_token = bcrypt($password);
        $created_at = Carbon::now();
         //$hpass = bcrypt($password);
//        if (Hash::check($check, $password))
//        {
//            $flag=0;
//        }
        $data = array(
            array('name'=>$name, 'email'=>$email,'phone'=>$phone,'password'=>$password,'address'=>$address,'remember_token'=>$remember_token,'created_at'=>$created_at)
        );
        Client::insert($data);
        //$article = Client::create($request->all());


        return response()->json([
            'code'=>'0000',
            'data'=>'success'],201);
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
