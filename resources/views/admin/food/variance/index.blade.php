@extends('admin.layout.master')
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
                        <h3 class="box-title">Manage Variances</h3>
                        <button style="margin-left: 10px;" type="button" class="btn btn-sm btn-primary btn-modal pull-right" data-href="{{action('Backend\VarianceController@create')}}" data-container=".variance_modal"><i class="fa fa-plus"></i> Add variance</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button id="sort_save"  type="button" class="btn btn-success btn-sm pull-right" onClick="saveItemVariancePosition();" >Save sort</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding TableData">

                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade variance_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('js')

<script src="{{ asset('admin/pages/variance.js') }}"></script>

@endsection