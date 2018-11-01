@extends('layouts.admin_layout')

@section('title', 'Sms History')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>View Sms History</h4>

                    </div>

                </div>

                <hr>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{session('success')}}!</strong>
                    </div>
                @endif
                @if(session('failed'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{session('failed')}}!</strong>
                    </div>
                @endif

                @if(isset($result))
                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Count</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($result as $res)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$res->name}}</td>
                                <td>{{$res->phone}}</td>
                                <td>{{$res->message}}</td>
                                <td>{{$res->message_counter}}</td>
                                <td>{{$res->message_price}} BDT</td>
                                <td>
                                    @if($res->message_sent_status==1)
                                        <span class="badge badge-pill badge-success">Success</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Failed</span>
                                    @endif
                                </td>
                                <td>{{$res->message_sent_notes}}</td>
                                <td>{{ date('Y-m-d',strtotime($res->created_at))}}</td>
                                <td>{{ date('h:i:s a',strtotime($res->created_at))}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                @endif
            </div>
            <!-- end row -->


        </div> <!-- end card-box -->
    </div><!-- end col -->

@endsection



{{--

@extends('layouts.app')

@section('content')

    <div class="col-10 mx-auto">
        <div class="card" style="margin-top: 20px">
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($result as $res)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$res->name}}</td>
                            <td>{{$res->phone}}</td>
                            <td>{{$res->message}}</td>
                            <td>{{ date('Y-m-d',strtotime($res->created_at))}}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection--}}
