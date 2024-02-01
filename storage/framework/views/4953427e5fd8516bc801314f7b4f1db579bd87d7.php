<?php $__env->startSection('content'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1><?php echo e($data['pageName']); ?></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
            <li class="active"><?php echo e($data['pageName']); ?></li>
        </ol>
    </section>


    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">Add new item</h3>
                        <a href="<?php echo e(route('item.index')); ?>" class="btn btn-sm btn-primary pull-right">Item Lists</a>
                    </div>

                    <?php echo Form::open(['url' => action('Backend\ItemController@store'), 'method' => 'POST', 'id' => 'storeForm','class' => 'itemForm', 'enctype' => 'multipart/form-data', 'role'=>'form']); ?>


                    <div class="box-body row">

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_name', 'Item name', array('class' => 'control-label')); ?>

                            <?php echo Form::text('item_name', null, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('item_name')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_name')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_new_price', 'Item new price ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                            <?php echo Form::text('item_new_price', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('item_new_price')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_new_price')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_old_price', 'Item old price ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                            <?php echo Form::text('item_old_price', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('item_old_price')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_old_price')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_cat_id', 'Category', array('class' => 'control-label')); ?>

                            <?php echo e(Form::select('item_cat_id', $categories, null, ['placeholder' => 'Please select category','id' => 'item_cat_id','class' => 'form-control select2'])); ?>

                            <?php if($errors->has('item_cat_id')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_cat_id')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_allergies', 'Allergy', array('class' => 'control-label')); ?>

                            <?php echo e(Form::select('item_allergies[]', $allergies, null, ['multiple' => 'multiple','data-placeholder' => 'Choose allergies','id' => 'item_allergies','class' => 'form-control select2'])); ?>

                            <?php if($errors->has('item_allergies')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_allergies')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_delivery_type', 'Available delivery method', array('class' => 'control-label')); ?>

                            <?php
                            $delivery_type = array('both'=>'Both','delivery'=>'Delivery','collection'=>'Collection');
                            ?>
                            <?php echo e(Form::select('item_delivery_type', $delivery_type, null, ['id' => 'item_delivery_type','class' => 'form-control'])); ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_delivery_type')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_variance', 'Is variance item ?', array('class' => 'control-label')); ?>

                            <?php
                            $yesNo = array('no'=>'No','yes'=>'Yes');
                            ?>
                            <?php echo e(Form::select('item_variance', $yesNo, null, ['id' => 'item_variance','class' => 'form-control'])); ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_variance')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_sub_menu', 'Is Sub-item ?', array('class' => 'control-label')); ?>

                            <?php
                            $yesNo = array('no'=>'No','yes'=>'Yes');
                            ?>
                            <?php echo e(Form::select('item_sub_menu', $yesNo, null, ['id' => 'item_sub_menu','class' => 'form-control'])); ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_sub_menu')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_sp_request_sts', 'Is Special request available ?', array('class' => 'control-label')); ?>

                            <?php
                            $yesNo = array('no'=>'No','yes'=>'Yes');
                            ?>
                            <?php echo e(Form::select('item_sp_request_sts', $yesNo, null, ['id' => 'item_sp_request_sts','class' => 'form-control'])); ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_sp_request_sts')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_offer_include', 'Item include in offer ?', array('class' => 'control-label')); ?>

                            <?php
                            $yesNo = array('yes'=>'Yes','no'=>'No');
                            ?>
                            <?php echo e(Form::select('item_offer_include', $yesNo, null, ['id' => 'item_offer_include','class' => 'form-control'])); ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_offer_include')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-4">
                            <?php echo Form::label('item_spice_level', 'Spice level ?', array('class' => 'control-label')); ?>

                            <?php
                            $spiceArray = array('no_spice'=>'No Spice','low'=>'Low','medium'=>'Medium','high'=>'High');
                            ?>
                            <?php echo e(Form::select('item_spice_level', $spiceArray, null, ['id' => 'item_spice_level','class' => 'form-control'])); ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_spice_level')); ?></strong>
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


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('cus_int_field', 'Custom Integer field', array('class' => 'control-label')); ?>

                            <?php echo Form::text('cus_int_field', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('cus_int_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('cus_int_field')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('cus_text_field', 'Custom Text field', array('class' => 'control-label')); ?>

                            <?php echo Form::text('cus_text_field', null, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('cus_text_field')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('cus_text_field')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('cus_tinyInt_field', 'Custom select field', array('class' => 'control-label')); ?>

                            <?php
                            $statusArray = array(''=>'Select one','0'=>'0','1'=>'1');
                            ?>
                            <?php echo e(Form::select('cus_tinyInt_field', $statusArray, null, ['id' => 'cus_tinyInt_field','class' => 'form-control'])); ?>

                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-4">
                            <?php echo Form::label('image','Image'); ?> <span class="recommended">Recommended size : 310x180 pixels </span>
                            <?php echo Form::file('image', ['id' => 'image', 'accept' => 'image/*']);; ?>

                            <small><p class="help-block">Max File size: 1MB</p></small>
                            <?php if($errors->has('image')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('image')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-8">
                            <?php echo Form::label('item_description', 'Item description', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('item_description', null, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('item_description')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('item_description')); ?></strong>
                            </p>
                        <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Add</button>
                    </div>

                    <?php echo Form::close(); ?>


                </div>

            </div>

        </div>

    </section>
    
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="<?php echo e(asset('admin/pages/item.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>