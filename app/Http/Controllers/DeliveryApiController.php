<?php

namespace App\Http\Controllers;
use App\Delivery;
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
