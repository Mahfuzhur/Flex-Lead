@extends('layouts.app')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title">Client</h4>
                            <p class="text-muted font-14 m-b-30">
                                Client Table
                            </p>

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <td>View</td>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>


                                <tbody>
                                @foreach($clients as $client)
                                    @if(!$client->deleted_at)
                                <tr>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>{{$client->address}}</td>
                                    <td><a href="/client/show/{{$client->id}}"> <i class="fa fa-eye"></i>
                                        Details</a>
                                    </td>

                                    <td>
                                        <a href="/client/{{$client->id}}/edit"><i class="md md-edit"></i>
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-smt" data-toggle="modal" data-target="#CenterModal"><i class="md md-close"></i></button>
                                    </td>
                                    <div id="CenterModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="CenterModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="CenterModalLabel">Suspend {{$client->name}} ?</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Confirm Suspend</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                    <form action="client/{{$client->id}}" method="post"
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

