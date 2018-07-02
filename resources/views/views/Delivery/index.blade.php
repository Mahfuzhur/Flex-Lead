@extends('layouts.app')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title">Delivery</h4>

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Client ID</th>
                                    <th>Delivery Transporter ID</th>
                                    <th>Receiver's Name</th>
                                    <th>Receiver's Phone</th>
                                    <th>GEO Start's Latitude</th>
                                    <th>GEO Start's Longitude</th>
                                    <th>GEO End Latitude</th>
                                    <th>GEO End Longitude</th>
                                    <th>Weight</th>
                                    <th>Total Price</th>
                                    <th>Pay Person</th>
                                    <th>OTP</th>
                                    <th>Paid Amount</th>

                                </tr>
                                </thead>


                                <tbody>
                                @foreach($deliveries as $delivery)
                                @if(!$delivery-> deleted_at)
                                <tr>
                                    <td>{{$delivery -> startTime}}</td>
                                    <td>{{$delivery -> endTime}}</td>
                                    <td>{{$delivery -> clientId}}</td>
                                    <td>{{$delivery -> deliveryTransporterId}}</td>
                                    <td>{{$delivery -> receiverName}}</td>
                                    <td>{{$delivery -> receiverPhone}}</td>
                                    <td>{{$delivery -> geoStartLatitude}}</td>
                                    <td>{{$delivery -> geoStartLongitude}}</td>
                                    <td>{{$delivery -> geoEndLatitude}}</td>
                                    <td>{{$delivery -> geoEndLongitude}}</td>
                                    <td>{{$delivery -> weight}}</td>
                                    <td>{{$delivery -> totalPrice}}</td>
                                    <td>{{$delivery -> payPerson}}</td>
                                    <td>{{$delivery -> otp}}</td>
                                    <td>{{$delivery -> paidAmount}}</td>

                                </tr>
                                @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </div>
    </div>
    @endsection
@section('script')
    <!-- Required datatable js -->
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#datatable').DataTable();

        });
    </script>
@endsection