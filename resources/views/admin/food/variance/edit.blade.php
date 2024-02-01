<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Variance</h4>
        </div>

        {!! Form::open(['url' => action('Backend\VarianceController@update', [$lists->id]), 'method' => 'PUT', 'id' => 'variance_edit_form', 'class' => '','role'=>'form']) !!}
        <div class="modal-body">

            {!! Form::hidden('id', $lists->id ,  ['class' => 'form-control id','required' => 'required']) !!}
            <div class="form-group col-sm-12">
                {!! Form::label('variance_name', 'Variance name', array('class' => 'control-label')) !!}
                {!! Form::text('variance_name', $lists->variance_name ,  ['class' => 'form-control variance_name','required' => 'required','onfocus' => 'this.value = "";','autocomplete' => 'off']); !!}
                @if ($errors->has('variance_name'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('variance_name') }}</strong>
                </p>
                @endif
            </div>

            <div class="clearfix"></div>

            <div class="form-group col-sm-12">
                {!! Form::label('item_id', 'Item', array('class' => 'control-label')) !!}
                {{ Form::select('item_id', $items, $lists->item_id, ['id' => 'item_id','class' => 'form-control select2','style' => 'width:100%']) }}
                @if ($errors->has('item_id'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('item_id') }}</strong>
                </p>
                @endif
            </div>

            <div class="clearfix"></div>


            <div class="form-group col-sm-12">
                {!! Form::label('item_new_price', 'Variance new price  ('.\Session::get('currency').')', array('class' => 'control-label')) !!}
                {!! Form::text('item_new_price', $lists->item_new_price , ['class' => 'form-control item_new_price','required' => 'required']); !!}
                @if ($errors->has('item_new_price'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('item_new_price') }}</strong>
                </p>
                @endif
            </div>

            <div class="clearfix"></div>

            <div class="form-group col-sm-12">
                {!! Form::label('item_old_price', 'Variance old price  ('.\Session::get('currency').')', array('class' => 'control-label')) !!}
                {!! Form::text('item_old_price', $lists->item_old_price , ['class' => 'form-control item_old_price']); !!}
                @if ($errors->has('item_old_price'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('item_old_price') }}</strong>
                </p>
                @endif
            </div>

            <div class="clearfix"></div>

            <div class="form-group col-sm-12">
                {!! Form::label('status', 'Status', array('class' => 'control-label')) !!}
                @php
                $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                @endphp
                {{ Form::select('status', $suatus, $lists->status, ['id' => 'status','class' => 'form-control']) }}
                @if ($errors->has('status'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('status') }}</strong>
                </p>
                @endif
            </div>

            <div class="clearfix"></div>
            <div class="clearfix"></div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

        {!! Form::close() !!}
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function(){
        $("#variance_name").autocomplete({
            source: "{{  route('suggestVariance') }}"
        });
    });

    $('.select2').select2();
    $( "#variance_edit_form" ).validate({
        rules: {
            variance_name:  {
                required: true,
                maxlength: 255,
            },
            item_id:  {
                required: true,
            },
            item_new_price:  {
                required: true,
                number: true,
            },
            status:  {
                required: true,
            },
        },

    });

</script>