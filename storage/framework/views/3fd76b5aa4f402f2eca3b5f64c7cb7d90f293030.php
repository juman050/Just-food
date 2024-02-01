

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
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Setting your store information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo Form::open(['url' => action('Backend\StoreSettingController@insertStoreInfo'), 'method' => 'POST', 'id' => 'storeForm','class' => '', 'role'=>'form']); ?>

                    <div class="box-body row">

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_name', 'Store name', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_name', $record->store_name, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('store_name')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_name')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_city', 'Store city', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_city', $record->store_city, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_city')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_city')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_state', 'Store state', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_state', $record->store_state, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_state')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_state')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_country', 'Store country', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_country', $record->store_country, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_country')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_country')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_postcode', 'Store postcode', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_postcode', $record->store_postcode, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_postcode')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_postcode')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_fax', 'Store fax', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_fax', $record->store_fax, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_fax')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_fax')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_support_number', 'Store support number', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_support_number', $record->store_support_number, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_support_number')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_support_number')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_support_email', 'Store support email', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_support_email', $record->store_support_email, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_support_email')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_support_email')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_owner_name', 'Store owner name', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_owner_name', $record->store_owner_name, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_owner_name')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_owner_name')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_owner_number', 'Store owner number', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_owner_number', $record->store_owner_number, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_owner_number')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_owner_number')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_owner_email', 'Store owner email', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_owner_email', $record->store_owner_email, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_owner_email')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_owner_email')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('store_active_theme', 'Store active theme', array('class' => 'control-label')); ?>

                            <?php
                            $suatus = array('1'=>'Justfood Image Theme','2'=>'Justfood Basic theme');
                            ?>
                            <?php echo e(Form::select('store_active_theme', $suatus, $record->store_active_theme, ['id' => 'store_active_theme','class' => 'form-control'])); ?>

                        </div>


                        <div class="clearfix"></div>


                        <div class="form-group col-sm-6">
                            <?php echo Form::label('store_address', 'Store address', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('store_address', $record->store_address, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('store_address')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_address')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('store_map', 'Store map', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('store_map', $record->store_map, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('store_map')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_map')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="clearfix"></div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('store_custom_text_1', 'Custom field 1', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_custom_text_1', $record->store_custom_text_1, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_custom_text_1')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_custom_text_1')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('store_custom_text_2', 'Custom field 2', array('class' => 'control-label')); ?>

                            <?php echo Form::text('store_custom_text_2', $record->store_custom_text_2, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('store_custom_text_2')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_custom_text_2')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('store_custom_textarea_1', 'Custom textarea 1', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('store_custom_textarea_1', $record->store_custom_textarea_1, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('store_custom_textarea_1')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_custom_textarea_1')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-6">
                            <?php echo Form::label('store_custom_textarea_2', 'Custom textarea 2', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('store_custom_textarea_2', $record->store_custom_textarea_2, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('store_custom_textarea_2')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('store_custom_textarea_2')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>

                    <?php echo Form::close(); ?>

                </div>
                <!-- /.box -->

            </div>

        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin/pages/storeSetting.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>