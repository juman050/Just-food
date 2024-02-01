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

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Faq lists </h3>
                        <button id="sort_save"  type="button" class="btn btn-primary btn-sm pull-right" onClick="saveFaqPosition();" >Save sort</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped text-center" id="Table">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 35%">Question ?</th>
                                    <th style="width: 50%">Answer</th>
                                    <th style="width: 5%">Status</th>
                                    <th style="width: 5%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="row_position">
                                @if($faqs)
                                @php
                                $i=1;
                                @endphp
                                @foreach($faqs as $faq)
                                <tr id="{!! $faq->id !!}">
                                    <td style="text-align: left !important;">{{$i++}}</td>
                                    <td style="text-align: left !important;">{{$faq->question}}</td>
                                    <td style="text-align: left !important;">{{$faq->answer}}</td>
                                    <td>
                                        <div class="switch">
                                            <input type="checkbox" id="switch{{ $faq->id }}" data-id="{{ $faq->id }}" class="switch__input" {{ $faq->status=='disable' ? '' : 'checked' }} >
                                            <label for="switch{{ $faq->id }}" class="switch__label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" onclick="deleteFaq({!! $faq->id !!})" class="btn btn-xs btn-danger del{{$faq->id}}">Delete</a></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">No faq data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="box box-primary">
                    {!! Form::open(['url' => action('Backend\PageSettingController@storeFaqs'), 'method' => 'POST', 'id' => 'storeFAQInfo', 'class' => '','role'=>'form']) !!}
                    <div class="box-body row">

                        <div class="form-group col-sm-12">
                            {!! Form::label('question', 'Question ?', array('class' => 'control-label')) !!}
                            {!! Form::text('question', null , ['class' => 'form-control','required' => 'required']); !!}
                            @if ($errors->has('question'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('question') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-12">

                            {!! Form::label('answer', 'Answer', array('class' => 'control-label')) !!}
                            {!! Form::textarea('answer', null, ['class' => 'form-control textarea']); !!}
                            @if ($errors->has('answer'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('answer') }}</strong>
                            </p>
                            @endif
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-12">
                            {!! Form::label('status', 'Status', array('class' => 'control-label')) !!}
                            @php
                            $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                            @endphp
                            {{ Form::select('status', $suatus, null, ['id' => 'status','class' => 'form-control']) }}
                        </div>

                        <div class="clearfix"></div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js')
<script src="{{ asset('admin/pages/pageSetting.js') }}"></script>
@endsection