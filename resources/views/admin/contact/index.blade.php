@extends('admin.layout.master')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{$data['pageName']}}</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
                <li class="active">{{$data['pageName']}}</li>
            </ol>
        </section>


        <section class="content">

            <div class="row">

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Contact messages</h3>
                        </div>
                    <div class="box-body no-padding">
                        <table class="table table-striped text-center" id="Table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Name</th>
                                    <th >Email</th>
                                    <th >Subject</th>
                                    <th >Time</th>
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
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->email}}</td>
                                    <td>{{$list->subject}}</td>
                                    <td>{{$list->created_at}}</td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="viewMessage('{!! $list->name !!}','{!! $list->email !!}','{!! $list->subject !!}','{!! $list->message !!}')" class="btn btn-xs btn-primary">View</a>
                                        <a href="javascript:void(0);" onclick="replyMessage('{!! $list->id !!}','{!! $list->name !!}','{!! $list->email !!}','{!! $list->subject !!}')" class="btn btn-xs btn-success">Reply</a>
                                        <a href="javascript:void(0);" onclick="deleteMessage('{!! $list->id !!}')" class="btn btn-xs btn-danger del{{$list->id}}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">No contact data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>

            </div>

        </section>

    </div>

    <div class="modal fade" id="viewModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">View Message</h4>
                </div>

                <div class="modal-body">
                    <p><b>Name : </b><span class="name"></span></p>
                    <p><b>Email : </b><span class="email"></span></p>
                    <p><b>Subject : </b><span class="subject"></span></p>
                    <p><b>Message : </b><span class="message"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="replyModel">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reply message</h4>
                </div>

                {!! Form::open(['url' => action('Backend\ContactController@replyMessage'), 'method' => 'POST', 'id' => 'replyForm', 'class' => '','role'=>'form']) !!}

                <div class="modal-body">

                    {!! Form::hidden('id', null , ['class' => 'form-control id','required' => 'required']); !!}

                    <div class="form-group col-sm-12">
                        {!! Form::label('name', 'Name', array('class' => 'control-label')) !!}
                        {!! Form::text('name', null , ['class' => 'form-control name','required' => 'required']); !!}
                        @if ($errors->has('name'))
                        <p class="help-block error_login">
                            <strong>{{ $errors->first('name') }}</strong>
                        </p>
                        @endif
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-sm-12">
                        {!! Form::label('email', 'Email', array('class' => 'control-label')) !!}
                        {!! Form::text('email', null , ['class' => 'form-control email','required' => 'required']); !!}
                        @if ($errors->has('email'))
                        <p class="help-block error_login">
                            <strong>{{ $errors->first('email') }}</strong>
                        </p>
                        @endif
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-sm-12">
                        {!! Form::label('subject', 'Subject', array('class' => 'control-label')) !!}
                        {!! Form::text('subject', null , ['class' => 'form-control subject','required' => 'required']); !!}
                        @if ($errors->has('subject'))
                        <p class="help-block error_login">
                            <strong>{{ $errors->first('subject') }}</strong>
                        </p>
                        @endif
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-sm-12">
                        {!! Form::label('message', 'Message', array('class' => 'control-label')) !!}
                        {!! Form::textarea('message', null , ['class' => 'form-control','rows' => '5','required' => 'required']); !!}
                        @if ($errors->has('message'))
                        <p class="help-block error_login">
                            <strong>{{ $errors->first('message') }}</strong>
                        </p>
                        @endif
                    </div>
                    <div class="clearfix"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reply</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('admin/pages/contact.js') }}"></script>
@endsection