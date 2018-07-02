<?php

namespace App\Http\Controllers;
use DB;
use App\Client;
use Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $clients = DB::table('client')->get();
        return view('client.index', compact('clients'));
    }
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('client.edit',compact('client'));
    }
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $input = $request->all();
        $client->fill($input)->save();
        return redirect('/client');

    }
    public function show($id){
        $client = Client::findOrFail($id);
        return view('client.show',compact('client'));
    }
    public function destroy($id){
        Client::destroy($id);
        return redirect('/client');
    }
}
