@extends('layouts.app')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><a href="/transporter/create"><button type="button"  class="btn btn-success waves-effect waves-light">Add Transporter</button></a></h4>

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Nid</th>
                                    <th>Address</th>
                                    <th>Picture</th>
                                    <th>Date Of Birth</th>
                                    <th>Email</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>


                                <tbody>
                                @foreach($transporters as $transporter)
                                    @if(!$transporter->deleted_at)
                                        <tr >
                                            <td>{{$transporter->name}}</td>
                                            <td>{{$transporter->phone}}</td>
                                            <td>{{$transporter->nid}}</td>
                                            <td>{{$transporter->address}}</td>
                                            <td>{{$transporter->pic}}</td>
                                            <td>{{$transporter->dob}}</td>
                                            <td>{{$transporter->email}}</td>
                                            <td>
                                                <a href="/transporter/show/{{$transporter->id}}"> <i class="fa fa-eye"></i>
                                                    Details
                                                </a>
                                            </td>
                                            <td>
                                                <a href="/transporter/{{$transporter->id}}/edit"><i class="md md-edit"></i>
                                                    Edit
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-smt" data-toggle="modal" data-target="#CenterModal"><i class="md md-close"></i></button>

                                            </td>


                                        </tr>
                                        <div id="CenterModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="CenterModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="CenterModalLabel">Suspend {{$transporter->name}} ?</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Confirm Suspend</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                        <form action="transporter/{{$transporter->id}}" method="post"
                                                              class="pull-left">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <button class="btn btn-danger waves-effect waves-light">
                                                                Suspend
                                                            </button>
                                                        </form>
                                                        {{--<button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>--}}
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
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