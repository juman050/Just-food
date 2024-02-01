<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Variance</h4>
            </div>

            <?php echo Form::open(['url' => action('Backend\VarianceController@store'), 'method' => 'POST', 'id' => 'variance_add_form', 'class' => '','role'=>'form']); ?>

            <div class="modal-body">

                <div class="form-group col-sm-12">
                    <?php echo Form::label('variance_name', 'Variance name', array('class' => 'control-label')); ?>

                    <?php echo Form::text('variance_name', null , ['class' => 'form-control variance_name','required' => 'required','onfocus' => 'this.value = "";','autocomplete' => 'off']);; ?>


                    <?php if($errors->has('variance_name')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('variance_name')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    <?php echo Form::label('item_id', 'Item', array('class' => 'control-label')); ?>

                    <?php echo e(Form::select('item_id', $items, null, ['id' => 'item_id','class' => 'form-control select2','style' => 'width:100%'])); ?>

                    <?php if($errors->has('item_id')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('item_id')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    <?php echo Form::label('item_new_price', 'Variance new price ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                    <?php echo Form::text('item_new_price', null , ['class' => 'form-control item_new_price','required' => 'required']);; ?>

                    <?php if($errors->has('item_new_price')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('item_new_price')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    <?php echo Form::label('item_old_price', 'Variance old price  ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                    <?php echo Form::text('item_old_price', null , ['class' => 'form-control item_old_price']);; ?>

                    <?php if($errors->has('item_old_price')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('item_old_price')); ?></strong>
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

        $(document).ready(function(){
            $("#variance_name").autocomplete({
                source: "<?php echo e(route('suggestVariance')); ?>"
            });
        });


        $('.select2').select2();
        $( "#variance_add_form" ).validate({
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
                item_old_price:  {
                    number: true,
                },
                status:  {
                    required: true,
                },
            },

        });

    </script>