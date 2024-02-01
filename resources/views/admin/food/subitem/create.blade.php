<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Sub-item</h4>
            </div>

            {!! Form::open(['url' => action('Backend\SubitemController@store'), 'method' => 'POST', 'id' => 'subitem_add_form', 'class' => '','role'=>'form']) !!}
            <div class="modal-body">

                <div class="form-group col-sm-12">
                    {!! Form::label('sub_item_name', 'Sub-item name', array('class' => 'control-label')) !!}
                    {!! Form::text('sub_item_name', null , ['class' => 'form-control','required' => 'required']); !!}

                    @if ($errors->has('sub_item_name'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('sub_item_name') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    {!! Form::label('required', 'Required', array('class' => 'control-label')) !!}
                    @php
                    $requires = array('no'=> 'No','yes'=>'Yes');
                    @endphp
                    {{ Form::select('required', $requires, null, ['id' => 'required','class' => 'form-control']) }}
                    @if ($errors->has('required'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('required') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    {!! Form::label('min_value', 'Min-value', array('class' => 'control-label')) !!}
                    {!! Form::text('min_value', 1 , ['class' => 'form-control min_value','required' => 'required']); !!}
                    @if ($errors->has('min_value'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('min_value') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    {!! Form::label('max_value', 'Max-value', array('class' => 'control-label')) !!}
                    {!! Form::text('max_value', 1 , ['class' => 'form-control max_value','required' => 'required']); !!}
                    @if ($errors->has('max_value'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('max_value') }}</strong>
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
                    @if ($errors->has('status'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('status') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <script type="text/javascript">

        $('.select2').select2();

        $( "#subitem_add_form" ).validate({
            rules: {
                sub_item_name:  {
                    required: true,
                    maxlength: 255,
                },
                required:  {
                    required: true,
                },
                min_value:  {
                    required: true,
                },
                max_value:  {
                    required: true,
                },
                status:  {
                    required: true,
                },
            },

        });

    </script>