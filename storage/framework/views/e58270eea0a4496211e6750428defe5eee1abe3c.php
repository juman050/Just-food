<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Postcode</h4>
            </div>

            <?php echo Form::open(['url' => action('Backend\PostcodeController@update', [$postcode->id]), 'method' => 'PUT', 'id' => 'postcode_edit_form', 'class' => '','role'=>'form']); ?>

            <div class="modal-body">

                <div class="form-group col-sm-12">
                    <?php echo Form::label('postcode_area', 'Postcode', array('class' => 'control-label')); ?>

                    <?php echo Form::text('postcode_area', $postcode->postcode_area , ['class' => 'form-control postcode_area','required' => 'required']);; ?>

                    <?php if($errors->has('postcode_area')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('postcode_area')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>


                <div class="form-group col-sm-12">
                    <?php echo Form::label('postcode_delivery_charge', 'Delivery charge ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                    <?php echo Form::text('postcode_delivery_charge', $postcode->postcode_delivery_charge , ['class' => 'form-control postcode_delivery_charge','required' => 'required']);; ?>

                    <?php if($errors->has('postcode_delivery_charge')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('postcode_delivery_charge')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    <?php echo Form::label('postcode_minimum_order', 'Minimum order  ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                    <?php echo Form::text('postcode_minimum_order', $postcode->postcode_minimum_order , ['class' => 'form-control postcode_minimum_order','required' => 'required']);; ?>

                    <?php if($errors->has('postcode_minimum_order')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('postcode_minimum_order')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

            <?php echo Form::close(); ?>

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