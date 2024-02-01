<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Sub-item</h4>
            </div>

            <?php echo Form::open(['url' => action('Backend\SubitemController@store'), 'method' => 'POST', 'id' => 'subitem_add_form', 'class' => '','role'=>'form']); ?>

            <div class="modal-body">

                <div class="form-group col-sm-12">
                    <?php echo Form::label('sub_item_name', 'Sub-item name', array('class' => 'control-label')); ?>

                    <?php echo Form::text('sub_item_name', null , ['class' => 'form-control','required' => 'required']);; ?>


                    <?php if($errors->has('sub_item_name')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('sub_item_name')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    <?php echo Form::label('required', 'Required', array('class' => 'control-label')); ?>

                    <?php
                    $requires = array('no'=> 'No','yes'=>'Yes');
                    ?>
                    <?php echo e(Form::select('required', $requires, null, ['id' => 'required','class' => 'form-control'])); ?>

                    <?php if($errors->has('required')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('required')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    <?php echo Form::label('min_value', 'Min-value', array('class' => 'control-label')); ?>

                    <?php echo Form::text('min_value', 1 , ['class' => 'form-control min_value','required' => 'required']);; ?>

                    <?php if($errors->has('min_value')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('min_value')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    <?php echo Form::label('max_value', 'Max-value', array('class' => 'control-label')); ?>

                    <?php echo Form::text('max_value', 1 , ['class' => 'form-control max_value','required' => 'required']);; ?>

                    <?php if($errors->has('max_value')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('max_value')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>


                <div class="form-group col-sm-12">
                    <?php echo Form::label('status', 'Status', array('class' => 'control-label')); ?>

                    <?php
                    $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                    ?>
                    <?php echo e(Form::select('status', $suatus, null, ['id' => 'status','class' => 'form-control'])); ?>

                    <?php if($errors->has('status')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('status')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

            <?php echo Form::close(); ?>

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