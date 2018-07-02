@extends('layouts.app')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                        <div class="profile-detail card-box">
                            <div>
                                <img src="/assets/images/users/avatar-2.jpg" class="rounded-circle" alt="profile-image">


                                <hr>
                                <h4 class="text-uppercase font-18 font-600">{{$client->name}}</h4>
                                <p class="text-muted font-13 m-b-30">
                                    Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                                </p>

                                <div class="text-left">
                                    <p class="text-muted font-13"><strong><code>Full Name :</code></strong> <span class="m-l-15">{{$client->name}}</span></p>

                                    <p class="text-muted font-13"><strong><code>Mobile    :</code></strong><span class="m-l-15">{{$client->phone}}</span></p>

                                    <p class="text-muted font-13"><strong><code>Location  :</code></strong> <span class="m-l-15">{{$client->address}}</span></p>

                                </div>


                                <div class="button-list m-t-20">
                                    <button type="button" class="btn btn-facebook waves-effect waves-light">
                                        <i class="fa fa-facebook"></i>
                                    </button>

                                    <button type="button" class="btn btn-twitter waves-effect waves-light">
                                        <i class="fa fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-linkedin waves-effect waves-light">
                                        <i class="fa fa-linkedin"></i>
                                    </button>

                                    <button type="button" class="btn btn-dribbble waves-effect waves-light">
                                        <i class="fa fa-dribbble"></i>
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9">
                        <div class="profile-detail card-box">
                            <h4 class="m-t-0 header-title">{{$client->name}}'s Services History</h4>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                                </thead>


                                <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                                <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>2011/07/25</td>
                                    <td>$170,750</td>
                                </tr>
                                <tr>
                                    <td>Ashton Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>66</td>
                                    <td>2009/01/12</td>
                                    <td>$86,000</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection