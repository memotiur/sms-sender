@extends('layouts.admin_layout')

@section('title', 'Dashboard')
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Daily Statistics</h4>
            <p class="text-muted page-title-alt">Click to see details !</p>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6 col-lg-6 col-xl-3">
            <a href="/sell/list">
                <div class="widget-bg-color-icon card-box fadeInDown animated">
                    <div class="bg-icon bg-icon-info pull-left">
                        <i class="md md-attach-money text-info"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter">$ {{$grand_total_price}}</b></h3>
                        <p class="text-muted mb-0">Today's Total Sell</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>


        <div class="col-md-6 col-lg-6 col-xl-3">
            <a href="/sell/list">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-purple pull-left">
                        <i class="md md-add-shopping-cart text-purple"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter">{{$total_sell}}</b></h3>
                        <p class="text-muted mb-0">Today Product Sales</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-3">
            <a href="/expense/show">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-info pull-left">
                        <i class="md md-equalizer text-info"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter">$ {{$total_expense}}</b></h3>
                        <p class="text-muted mb-0">Expense</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-3">
            <a href="/sell/list">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-purple pull-left">
                        <i class="md md-remove-red-eye text-purple"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter">$ {{$this_month_total_sell}}</b></h3>
                        <p class="text-muted mb-0">This Month Total Sell</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    {{--
        <div class="row">
            <div class="col-lg-12 col-xl-4">
                <div class="card-box">
                    <div class="bar-widget">
                        <div class="table-box">
                            <div class="table-detail">
                                <div class="iconbox bg-info">
                                    <i class="icon-layers"></i>
                                </div>
                            </div>

                            <div class="table-detail">
                                <h4 class="m-t-0 m-b-5"><b>12560</b></h4>
                                <p class="text-muted m-b-0 m-t-0">Total Revenue</p>
                            </div>
                            <div class="table-detail text-right">
                                                <span data-plugin="peity-bar" data-colors="#34d3eb,#ebeff2" data-width="120"
                                                      data-height="45">5,3,9,6,5,9,7,3,5,2,9,7,2,1</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-xl-4">
                <div class="card-box">
                    <div class="bar-widget">
                        <div class="table-box">
                            <div class="table-detail">
                                <div class="iconbox bg-custom">
                                    <i class="icon-layers"></i>
                                </div>
                            </div>

                            <div class="table-detail">
                                <h4 class="m-t-0 m-b-5"><b>356</b></h4>
                                <p class="text-muted m-b-0 m-t-0">Ave. weekly Sales</p>
                            </div>
                            <div class="table-detail text-right">
                                                <span data-plugin="peity-pie" data-colors="#5fbeaa,#ebeff2" data-width="50"
                                                      data-height="45">1/5</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-xl-4">
                <div class="card-box">
                    <div class="bar-widget">
                        <div class="table-box">
                            <div class="table-detail">
                                <div class="iconbox bg-danger">
                                    <i class="icon-layers"></i>
                                </div>
                            </div>

                            <div class="table-detail">
                                <h4 class="m-t-0 m-b-5"><b>96562</b></h4>
                                <p class="text-muted m-b-0 m-t-0">Visiters</p>
                            </div>
                            <div class="table-detail text-right">
                                                <span data-plugin="peity-donut" data-colors="#f05050,#ebeff2"
                                                      data-width="50" data-height="45">1/5</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    --}}
    {{--

        <div class="row">

            <div class="col-lg-12 col-xl-4">
                <div class="card-box">
                    <h4 class="text-dark header-title m-t-0 m-b-30">Daily Sales</h4>

                    <div class="widget-chart text-center">
                        <div id="sparkline3"></div>
                        <ul class="list-inline m-t-15">
                            <li>
                                <h5 class="text-muted m-t-20">Target</h5>
                                <h4 class="m-b-0">$1000</h4>
                            </li>
                            <li>
                                <h5 class="text-muted m-t-20">Last week</h5>
                                <h4 class="m-b-0">$523</h4>
                            </li>
                            <li>
                                <h5 class="text-muted m-t-20">Last Month</h5>
                                <h4 class="m-b-0">$965</h4>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-12 col-xl-4">
                <div class="card-box">
                    <h4 class="text-dark  header-title m-t-0 m-b-30">Weekly Sales</h4>

                    <div class="widget-chart text-center">
                        <div id="sparkline2"></div>
                        <ul class="list-inline m-t-15">
                            <li>
                                <h5 class="text-muted m-t-20">Target</h5>
                                <h4 class="m-b-0">$1000</h4>
                            </li>
                            <li>
                                <h5 class="text-muted m-t-20">Last week</h5>
                                <h4 class="m-b-0">$523</h4>
                            </li>
                            <li>
                                <h5 class="text-muted m-t-20">Last Month</h5>
                                <h4 class="m-b-0">$965</h4>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-12 col-xl-4">
                <div class="card-box">
                    <h4 class="text-dark  header-title m-t-0 m-b-30">Monthly Sales</h4>

                    <div class="widget-chart text-center">
                        <div id="sparkline1"></div>
                        <ul class="list-inline m-t-15">
                            <li>
                                <h5 class="text-muted m-t-20">Target</h5>
                                <h4 class="m-b-0">$1000</h4>
                            </li>
                            <li>
                                <h5 class="text-muted m-t-20">Last week</h5>
                                <h4 class="m-b-0">$523</h4>
                            </li>
                            <li>
                                <h5 class="text-muted m-t-20">Last Month</h5>
                                <h4 class="m-b-0">$965</h4>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>


        </div>
    --}}

    <div class="row">

        <div class="col-8">

            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        Recent Sell
                    </h3>
                    <div class="portlet-widgets">
                        <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                        <span class="divider"></span>
                        <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i
                                    class="ion-minus-round"></i></a>
                        <span class="divider"></span>
                        <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="portlet2" class="panel-collapse collapse show">
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($sells as $sell)
                                    <tr>
                                        <td><a href="/sells/details/{{$sell->invoice}}" class="text-dark"><b>{{$i++}}</b></a></td>
                                        <td>{{$sell->customer_name}}</td>
                                        <td>$ {{$sell->grand_total_price}}</td>
                                        <td>
                                            @if($sell->paid_status==1)
                                                <span class="label label-info">Paid</span>
                                            @else
                                                <span class="label label-danger">Due</span>
                                            @endif

                                           </td>
                                        <td>{{date('d/m/Y'),strtotime($sell->created_at)}}</td>
                                        <td><a href="/sells/details/{{$sell->invoice}}" class="text-dark"><p class="text-danger">Show</p></a></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

@endsection