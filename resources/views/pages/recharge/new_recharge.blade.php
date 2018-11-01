@extends('layouts.admin_layout')

@section('title', 'Recahrge Proces')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">Recharge</h4>
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-10 mx-auto" style="padding-top: 20px">
                        <form class="form-horizontal" method="post" action="/recharge/make"
                              enctype="multipart/form-data">

                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="phone">Transaction ID</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="transaction_id" name="transaction_id" required/>
                                    <input class="form-control" type="hidden" value="{{csrf_token()}}" name="_token" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                </div>
                                <div class="col-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>


                        </form>

                    </div>

                </div>
                <!-- end row -->

            </div> <!-- end card-box -->
        </div><!-- end col -->
    </div>
    <!-- end row -->

@endsection



