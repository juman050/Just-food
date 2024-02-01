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
                        <h3 class="box-title">Restaurant opening/closing time schedule</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped text-center" id="Table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Day</th>
                                    <th >Opening time</th>
                                    <th >Closing time time</th>
                                    <th >Status</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($lists)
                                @php
                                $i=1;
                                @endphp
                                @foreach($lists as $list)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$list->day}}</td>
                                    <td>{{$list->openingTime}}</td>
                                    <td>{{$list->closingTime}}</td>
                                    <td>
                                        <div class="switch">
                                            <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input" {{ $list->restaurantStatus=='close' ? '' : 'checked' }} >
                                            <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" onclick="editOpenCloseTime('{!! $list->id !!}','{!! $list->openingTime !!}','{!! $list->closingTime !!}','{!! $list->day !!}')" class="btn btn-xs btn-primary">Change</a></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">No list data</td>
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

<div class="modal fade" id="openCloseModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change open/close time for "<span id="day"></span>"</h4>
            </div>

            {!! Form::open(['url' => action('Backend\RestaurantOpenCloseController@updateOpenCloseData'), 'method' => 'POST', 'id' => 'openCloseForm', 'class' => '','role'=>'form']) !!}
            <div class="modal-body">

                {!! Form::hidden('id', null , ['class' => 'form-control id','required' => 'required']); !!}

                <div class="form-group col-sm-12">
                    {!! Form::label('openingTime', 'Opening time', array('class' => 'control-label')) !!}
                    {!! Form::text('openingTime', null , ['class' => 'form-control openingTime','required' => 'required']); !!}
                    @if ($errors->has('openingTime'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('openingTime') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    {!! Form::label('closingTime', 'Closing time', array('class' => 'control-label')) !!}
                    {!! Form::text('closingTime', null , ['class' => 'form-control closingTime','required' => 'required']); !!}
                    @if ($errors->has('closingTime'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('closingTime') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('js')

    <script src="{{ asset('admin/pages/open_close.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

@endsection