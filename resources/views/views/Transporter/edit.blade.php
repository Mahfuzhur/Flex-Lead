@extends('layouts.app')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-20">
                                        <form class="form-horizontal" role="form" action="/transporter/{{$transporter->id}}" method="post">
                                            {{method_field('PUT')}}
                                            {{csrf_field()}}
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Name</label>
                                                <div class="col-10">
                                                    <input type="text" name="name" value="{{$transporter->name}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Phone</label>
                                                <div class="col-10">
                                                    <input type="text" name="phone" value="{{$transporter->phone}}" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">NID</label>
                                                <div class="col-10">
                                                    <input type="text" name="nid" value="{{$transporter->nid}}" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Address</label>
                                                <div class="col-10">
                                                    <input type="text" name="address" value="{{$transporter->address}}" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Picture</label>
                                                <div class="col-10">
                                                    <input type="file" name="pic" class="form-control" value="{{$transporter->pic}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Date of Birth</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="date" value="{{$transporter->dob}}" name="dob">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-2 col-form-label">Email</label>
                                                <div class="col-10">
                                                    <input type="email" name="email" value="{{$transporter->email}}" class="form-control" >
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection