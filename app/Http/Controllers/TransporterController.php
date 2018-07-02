<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Transporter;
use Illuminate\Http\Request;

class TransporterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $transporters = DB::table('transporter')->get();
        return view('transporter.index', compact('transporters'));
    }
    public function create()
    {
        return view('transporter.create');
    }
    public function edit($id)
    {
        $transporter = Transporter::findOrFail($id);
        return view('transporter.edit',compact('transporter'));
    }
    public function update(Request $request, $id)
    {
        $transporter = Transporter::findOrFail($id);
        $input = $request->all();
        $transporter->fill($input)->save();
        return redirect('/transporter');

    }

    public function store(Request $request)
    {
        Transporter::create($request->all());  //method 1 to return full table
        //return redirect()->back();
        return redirect('/transporter');
    }

    public function show($id)
    {
        $transporter = Transporter::findOrFail($id);
        return view('transporter.show',compact('transporter'));
    }
    public function destroy($id){
        Transporter::destroy($id);
        return redirect('/transporter');
    }


}
