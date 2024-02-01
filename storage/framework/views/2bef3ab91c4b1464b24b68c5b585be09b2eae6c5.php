<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Mileage</h4>
            </div>

            <?php echo Form::open(['url' => action('Backend\MileageController@update', [$mileage->id]), 'method' => 'PUT', 'id' => 'mileage_edit_form', 'class' => '','role'=>'form']); ?>

            <div class="modal-body">

                <div class="form-group col-sm-12">
                    <?php echo Form::label('mileage_length', 'Mileage length', array('class' => 'control-label')); ?>

                    <?php echo Form::text('mileage_length', $mileage->mileage_length , ['class' => 'form-control mileage_length','required' => 'required']);; ?>

                    <?php if($errors->has('mileage_length')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('mileage_length')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>


                <div class="form-group col-sm-12">
                    <?php echo Form::label('mileage_delivery_charge', 'Delivery charge  ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                    <?php echo Form::text('mileage_delivery_charge', $mileage->mileage_delivery_charge , ['class' => 'form-control mileage_delivery_charge','required' => 'required']);; ?>

                    <?php if($errors->has('mileage_delivery_charge')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('mileage_delivery_charge')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    <?php echo Form::label('mileage_minimum_order', 'Minimum order ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                    <?php echo Form::text('mileage_minimum_order', $mileage->mileage_minimum_order , ['class' => 'form-control mileage_minimum_order','required' => 'required']);; ?>

                    <?php if($errors->has('mileage_minimum_order')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('mileage_minimum_order')); ?></strong>
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

        $( "#mileage_edit_form" ).validate({
            rules: {
                mileage_area:  {
                    required: true,
                },
                mileage_delivery_charge:  {
                    required: true,
                    number: true,
                },
                mileage_minimum_order:  {
                    required: true,
                    number: true,
                },
            },

        });

    </script>