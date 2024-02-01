@extends('admin.layout.master')
@section('css')

<style type="text/css">
    .bg-gray {color: #000;background-color: #d2d6de !important;}
    .bg-green{background-color: #00a65a !important;}
</style>

@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$data['pageName']}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
            <li class="active">{{$data['pageName']}}</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!-- <h3 class="box-title">Manage Orders</h3> -->
                        <div class="row">
                            <div class="col-md-6 col-xs-12">


                                <p>Search by date : </p>

                                <form action="{{url('backoffice/orders/date-filter')}}" method="POST" id="filter-form-date-range">
                                    @csrf
                                    <!-- Date range -->
                                    <div class="form-group">

                                        <div class="input-group col-md-8" style="float: left;">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="date" type="text" class="form-control pull-right" id="reservation">
                                        </div>
                                        <input hidden="hidden" type="hidden" name="order_type" value="processingorder">

                                        <button style="margin-left: 5px;" type="submit" class="btn btn-md btn-primary">Search</button>
                                        <!-- /.input group -->
                                    </div>

                                </form>


                            </div>
                            <div class="col-md-6 col-xs-12">


                                <p class="text-right">&nbsp;</p>
                                <form action="{{url('backoffice/orders/filter')}}" method="POST" id="filter-form-year">
                                    @csrf
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="processingorder">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="year">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_year"><input type="radio" name="date-filter" value="year"/>This year</label>
                                    </div>
                                </form>

                                <form action="{{url('backoffice/orders/filter')}}" method="POST" id="filter-form-month">
                                    @csrf
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="processingorder">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="month">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_month"><input type="radio" name="date-filter" value="month"/>This month</label>
                                    </div>
                                </form>

                                <form action="{{url('backoffice/orders/filter')}}" method="POST" id="filter-form-week">
                                    @csrf
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="processingorder">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="week">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_week"><input type="radio" name="date-filter" value="week"/>This week</label>
                                    </div>
                                </form>

                                <form action="{{url('backoffice/orders/filter')}}" method="POST" id="filter-form-today">
                                    @csrf
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="processingorder">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="today">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_today"><input type="radio" name="date-filter" value="today"/>Today</label> 
                                    </div>
                                </form>

                                <form action="{{url('backoffice/orders/filter')}}" method="POST" id="filter-form-all">
                                    @csrf
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="processingorder">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="all">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_all"><input type="radio" name="date-filter" value="all"/>All</label>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped table-bordered" id="Table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Order date</th>
                                    <th >Shipping method & time</th>
                                    <th >Customer name & number</th>
                                    <th >Address & Postcode</th>
                                    <th >Total</th>
                                    <th >Payment type(status)</th>
                                    <th >Order status</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($lists) > 0)
                                @php
                                $i=1;
                                @endphp
                                @foreach($lists as $list)
                                <tr id="{!! $list->id !!}">

                                    <td>{{$i++}}</td>
                                    <td>{{changeDateFormate($list->order_date)}}</td>
                                    <td>{{$list->order_delivery_type}}<br>{{$list->order_delivery_time}}</td>
                                    <td>{{$list->order_customer_name}}<br>{{$list->order_contact_number}}</td>
                                    <td>{{$list->order_address}}<br>{{$list->order_postcode}}{{', '.$list->order_postcode}}</td>
                                    <td>{{Session::get('currency')}} {{$list->order_total}}</td>
                                    <td>{{$list->order_pay_method}}({{$list->order_payment_status}})</td>
                                    <td><button class="btn btn-xs btn-defalut">{{$list->order_status}}</button></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Actions <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <li><a href="javascript:void(0)"  data-href="{{action('Backend\OrderController@show', [$list->id])}}" class="view_order_modal" ><i class="fa fa-eye"></i> View</a></li>

                                                @if($list->order_status != 'processing')
                                                <li><a href="javascript:void(0);" onclick="moveStatus('{!! $list->id !!}','processing')" class="del{{$list->id}}"><i class="fa fa-archive"></i> Move to Processing</a></li>
                                                @endif

                                                @if($list->order_status != 'delivered')
                                                <li><a href="javascript:void(0);" onclick="moveStatus('{!! $list->id !!}','delivered')" class="del{{$list->id}}"><i class="fa fa-archive"></i> Move to Delivered</a></li>
                                                @endif

                                                @if($list->order_status != 'cancelled')
                                                <li><a href="javascript:void(0);" onclick="moveStatus('{!! $list->id !!}','cancelled')" class="del{{$list->id}}"><i class="fa fa-archive"></i> Move to Cancelled</a></li>
                                                @endif

                                                @if($list->order_status != 'pending')
                                                <li><a href="javascript:void(0);" onclick="moveStatus('{!! $list->id !!}','pending')" class="del{{$list->id}}"><i class="fa fa-archive"></i> Move to Pending</a></li>
                                                @endif

                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9" class="text-center">No data in record yet</td>
                                </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade view_order_modal"  tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>


@endsection

@section('js')

<script type="text/javascript">

    $(document).on('click', '.view_order_modal', function(){

        $( "div.view_order_modal" ).load( $(this).data('href'), function(){

            $(this).modal('show');

        });

    });

    $(document).ready(function(){
        $('.btn_filter_all').click(function(e){
            $('#filter-form-all').submit();
        });
        $('.btn_filter_today').click(function(e){
            $('#filter-form-today').submit();
        });
        $('.btn_filter_week').click(function(e){
            $('#filter-form-week').submit();
        });
        $('.btn_filter_month').click(function(e){
            $('#filter-form-month').submit();
        });
        $('.btn_filter_year').click(function(e){
            $('#filter-form-year').submit();
        });
    });

    $("#reservation").daterangepicker({
        locale: {
            format: 'YYYY/MM/DD'
        }
    });

</script>
<script src="{{ asset('admin/pages/order.js') }}"></script>

@endsection