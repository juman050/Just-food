<?php $__env->startSection('css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/iCheck/all.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/timepicker/bootstrap-timepicker.min.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo e($data['pageName']); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
            <li class="active"><?php echo e($data['pageName']); ?></li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <?php echo Form::open(['url' => action('Backend\OfferController@store'), 'method' => 'POST', 'id' => 'storeForm','class' => '', 'enctype' => 'multipart/form-data', 'role'=>'form']); ?>



        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Offer desription</h3>
                        <a href="<?php echo e(route('offer.index')); ?>" class="btn btn-sm btn-primary pull-right">Offer Lists</a>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body row">

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('title', 'Title', array('class' => 'control-label')); ?>

                            <?php echo Form::text('title', null, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('title')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('title')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-3">
                            <?php echo Form::label('startdate', 'Start-date', array('class' => 'control-label')); ?>

                            <?php echo Form::text('startdate', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('startdate')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('startdate')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-3">
                            <?php echo Form::label('enddate', 'End-date', array('class' => 'control-label')); ?>

                            <?php echo Form::text('enddate', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('enddate')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('enddate')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('custom_text', 'Header top text', array('class' => 'control-label')); ?>

                            <?php echo Form::text('custom_text', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('custom_text')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('custom_text')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('days','Available days'); ?>

                            <br>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="sun" checked> Sunday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="mon" checked> Monday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="tue" checked> Tuesday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="wed" checked> Wednesday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="thu" checked> Thursday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="fri" checked> Friday</label>
                            <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="sat" checked> Saturday</label>
                        </div>


                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('start_time', 'Time start', array('class' => 'control-label')); ?>

                            <?php echo Form::text('start_time', null, ['class' => 'form-control start_time']);; ?>

                            <?php if($errors->has('start_time')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('start_time')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('end_time', 'Time end', array('class' => 'control-label')); ?>

                            <?php echo Form::text('end_time', null, ['class' => 'form-control end_time']);; ?>

                            <?php if($errors->has('end_time')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('end_time')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('display_banner', 'Display in banner ?', array('class' => 'control-label')); ?>

                            <?php
                            $yesNo = array('yes'=>'Yes','no'=>'No');
                            ?>
                            <?php echo e(Form::select('display_banner', $yesNo, null, ['id' => 'display_banner','class' => 'form-control'])); ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('display_banner')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>



                        <div class="form-group col-sm-4">
                            <?php echo Form::label('coupon_code', 'Coupon code', array('class' => 'control-label')); ?>

                            <?php echo Form::text('coupon_code', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('coupon_code')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('coupon_code')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('customer_use', 'Customer can use', array('class' => 'control-label')); ?>

                            <?php echo Form::text('customer_use', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('customer_use')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('customer_use')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('free_shipping', 'Free shipping', array('class' => 'control-label')); ?>

                            <?php
                            $yesNo = array('no'=>'No','yes'=>'Yes');
                            ?>
                            <?php echo e(Form::select('free_shipping', $yesNo, null, ['id' => 'free_shipping','class' => 'form-control'])); ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('free_shipping')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>



                        <div class="clearfix"></div>


                        <div class="form-group col-sm-8">
                            <?php echo Form::label('custom_int', 'Custom integer field', array('class' => 'control-label')); ?>

                            <?php echo Form::text('custom_int', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('custom_int')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('custom_int')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('status', 'Status', array('class' => 'control-label')); ?>

                            <?php
                            $statusArray = array('enable'=>'Enable','disable'=>'Disable');
                            ?>
                            <?php echo e(Form::select('status', $statusArray, null, ['id' => 'status','class' => 'form-control'])); ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('status')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-8">
                            <?php echo Form::label('description', 'Description', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('description', null, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('description')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('description')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('image','Image'); ?>

                            <?php echo Form::file('image', ['id' => 'image', 'accept' => 'image/*']);; ?>

                            <small><p class="help-block">Max File size: 1MB</p></small>
                            <?php if($errors->has('image')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('image')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>

        </div>


        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Offer Conditions</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">

                        <div class="form-group" hidden>
                            <?php echo Form::label('payment_type', '1) Payment Type :', array('class' => 'col-sm-2 control-label')); ?>

                            <div class="col-sm-10">
                                <?php
                                $paymentOptions = array(''=>'None','cash'=>'Cash','online'=>'Online');
                                ?>
                                <?php echo e(Form::select('payment_type', $paymentOptions, null, ['id' => 'payment_type','class' => 'form-control'])); ?>

                                <?php if($errors->has('payment_type')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('payment_type')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br><br>

                        <div class="form-group">
                            <?php echo Form::label('delivery_type', '1) Delivery Type :', array('class' => 'col-sm-2 control-label')); ?>

                            <div class="col-sm-10">
                                <?php
                                $deliveryOptions = array('delivery'=>'Delivery','collection'=>'Collection');
                                ?>
                                <?php echo e(Form::select('delivery_type', $deliveryOptions, null, ['id' => 'delivery_type','class' => 'form-control','placeholder' => 'Select delivery type'])); ?>

                                <?php if($errors->has('delivery_type')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('delivery_type')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br><br>

                        <div class="form-group">
                            <?php echo Form::label('subtotal', '2) Subtotal ', array('class' => 'col-sm-2 control-label')); ?>

                            <div class="col-sm-5">
                                <?php
                                $sign = array(''=>'None','equals'=>'is','not_equals'=>'is not','less_than'=>'Less than','greater_than'=>'is Greater than','less_than_equal'=>'Less than and equal to','greater_than_equal'=>'Greater than end equal to');
                                ?>
                                <?php echo e(Form::select('subtotal', $sign, null, ['id' => 'subtotal','class' => 'form-control'])); ?>

                                <?php if($errors->has('subtotal')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('subtotal')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-5">
                                <?php echo Form::text('sub_amount', null, ['placeholder' => \Session::get('currency').' 10','class' => 'form-control']);; ?>

                                <?php if($errors->has('sub_amount')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('sub_amount')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br><br>

                        <div class="form-group">
                            <?php echo Form::label('total_quantity', '3) Total quantity ', array('class' => 'col-sm-2 control-label')); ?>

                            <div class="col-sm-5">
                                <?php
                                $sign = array('equals'=>'is','not_equals'=>'is not','less_than'=>'Less than','greater_than'=>'is Greater than','less_than_equal'=>'Less than and equal to','greater_than_equal'=>'Greater than end equal to');
                                ?>
                                <?php echo e(Form::select('total_quantity', $sign, null, ['id' => 'total_quantity','class' => 'form-control','placeholder' => 'None'])); ?>

                                <?php if($errors->has('total_quantity')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('total_quantity')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-5">
                                <?php echo Form::text('qty_amount', null, ['placeholder' => '10','class' => 'form-control']);; ?>

                                <?php if($errors->has('qty_amount')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('qty_amount')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br><br>

                        <div class="form-group">
                            <?php echo Form::label('no_condition', '4) Without Condition :', array('class' => 'col-sm-2 control-label')); ?>

                            <div class="col-sm-10">
                                <?php
                                $condition = array('no'=>'No','yes'=>'Yes');
                                ?>
                                <?php echo e(Form::select('no_condition', $condition, null, ['id' => 'no_condition','class' => 'form-control','placeholder' => 'None'])); ?>

                                <?php if($errors->has('no_condition')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('no_condition')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br><br>

                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Offer Actions</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">


                        <div class="form-group">
                            <?php echo Form::label('discount_type', '1) Discount on total basket', array('class' => 'col-sm-3 control-label')); ?>

                            <div class="col-sm-5">
                                <?php
                                $type = array('percent'=>'Percent','fix_amount'=>'Fix amount');
                                ?>
                                <?php echo e(Form::select('discount_type', $type, null, ['id' => 'discount_type','class' => 'form-control','placeholder' => 'Select discount type'])); ?>

                                <?php if($errors->has('discount_type')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('discount_type')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4">
                                <?php echo Form::text('discount_amount', null, ['placeholder' => 'Discount amount','class' => 'form-control']);; ?>

                                <?php if($errors->has('discount_amount')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('discount_amount')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br><br>


                        <div class="form-group">
                            <?php echo Form::label('free_item', '2) Free Items ', array('class' => 'col-sm-3 control-label')); ?>

                            <div class="col-sm-5">
                                <select name="free_item[]" id="free_item" class="form-control select2" multiple="multiple">
                                    <option value="">Select items</option>
                                    <?php 

                                    foreach ($items as $item) {
                                        if(count($item->getVariances) > 0){
                                            foreach ($item->getVariances as $var) {
                                                $val = $var->pivot->item_id.'-'.$var->pivot->variance_id;
                                                $name = $var->variance_name.' '.$item->item_name.' ( '.\Session::get('currency').$var->pivot->item_new_price.' )';
                                                ?>
                                                <option value="<?=$val;?>"><?=$name;?></option>
                                                <?php
                                            }
                                        }else{
                                            $val = $item->id;
                                            $name = $item->item_name.' ( '.\Session::get('currency').$item->item_new_price.' )';
                                            ?>
                                            <option value="<?=$val;?>"><?=$name;?></option>
                                            <?php
                                        }
                                    }

                                    ?>

                                </select>
                                <?php if($errors->has('free_item')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('free_item')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4">
                                <?php echo Form::text('free_item_allowed', null, ['placeholder' => 'Maximum allowed item','class' => 'form-control']);; ?>

                                <?php if($errors->has('free_item_allowed')): ?>
                                <p class="help-block error_login">
                                    <strong><?php echo e($errors->first('free_item_allowed')); ?></strong>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br><br>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Add</button>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </div>


        <!-- /.row -->

        <?php echo Form::close(); ?>



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="<?php echo e(asset('admin/plugins/iCheck/icheck.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/pages/offer.js')); ?>"></script>
<script type="text/javascript">
    $(function () {


        // set default dates
        var start = new Date();
        var end = new Date(new Date().setYear(start.getFullYear()+1));

        $('#startdate').datepicker({
            startDate : start,
            format: "yyyy-mm-dd",
            endDate   : end
        }).on('changeDate', function(){
            $('#enddate').datepicker('setStartDate', new Date($(this).val()));
        }); 

        $('#enddate').datepicker({
            startDate : start,
            format: "yyyy-mm-dd",
            endDate   : end
        }).on('changeDate', function(){
            $('#startdate').datepicker('setEndDate', new Date($(this).val()));
        });


        //Timepicker
        $('.start_time').timepicker({
            showInputs: false,
            maxHours : 24,
            showMeridian : false,
        })
        //Timepicker
        $('.end_time').timepicker({
            showInputs: false,
            maxHours : 24,
            showMeridian : false,
        })


        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

    })
    
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>