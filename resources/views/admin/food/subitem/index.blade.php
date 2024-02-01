@extends('admin.layout.master')
@section('css')

<link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }}">

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
                        <h3 class="box-title">Manage Sub-items</h3>
                        <button style="margin-left: 10px;" type="button" class="btn btn-sm btn-primary btn-modal pull-right" data-href="{{action('Backend\SubitemController@create')}}" data-container=".subitem_modal"><i class="fa fa-plus"></i> Add new sub-items</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button id="sort_save"  type="button" class="btn btn-success btn-sm pull-right" onClick="saveSubItemPosition();" >Save sort</button>&nbsp;&nbsp;&nbsp;&nbsp;
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

<div class="modal fade subitem_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('js')

<script src="{{ asset('admin/pages/subitem.js') }}"></script>
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>

@endsection