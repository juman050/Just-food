<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Postcode</h4>
            </div>

            {!! Form::open(['url' => action('Backend\PostcodeController@update', [$postcode->id]), 'method' => 'PUT', 'id' => 'postcode_edit_form', 'class' => '','role'=>'form']) !!}
            <div class="modal-body">

                <div class="form-group col-sm-12">
                    {!! Form::label('postcode_area', 'Postcode', array('class' => 'control-label')) !!}
                    {!! Form::text('postcode_area', $postcode->postcode_area , ['class' => 'form-control postcode_area','required' => 'required']); !!}
                    @if ($errors->has('postcode_area'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('postcode_area') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="clearfix"></div>


                <div class="form-group col-sm-12">
                    {!! Form::label('postcode_delivery_charge', 'Delivery charge ('.\Session::get('currency').')', array('class' => 'control-label')) !!}
                    {!! Form::text('postcode_delivery_charge', $postcode->postcode_delivery_charge , ['class' => 'form-control postcode_delivery_charge','required' => 'required']); !!}
                    @if ($errors->has('postcode_delivery_charge'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('postcode_delivery_charge') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    {!! Form::label('postcode_minimum_order', 'Minimum order  ('.\Session::get('currency').')', array('class' => 'control-label')) !!}
                    {!! Form::text('postcode_minimum_order', $postcode->postcode_minimum_order , ['class' => 'form-control postcode_minimum_order','required' => 'required']); !!}
                    @if ($errors->has('postcode_minimum_order'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('postcode_minimum_order') }}</strong>
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

    <script type="text/javascript">

        $( "#postcode_edit_form" ).validate({
            rules: {
                postcode_area:  {
                    required: true,
                },
                postcode_delivery_charge:  {
                    required: true,
                    number: true,
                },
                postcode_minimum_order:  {
                    required: true,
                    number: true,
                },
            },

        });

    </script>