

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

                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo Form::open(['url' => action('Backend\PageSettingController@storeHomeInfo'), 'method' => 'POST', 'id' => 'storeHomeInfo', 'class' => '', 'files' => 'true','role'=>'form']); ?>

                    <div class="box-body row">

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('home_title', 'Home meta title', array('class' => 'control-label')); ?>

                            <?php echo Form::text('home_title', $homeData->home_title, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('home_title')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('home_title')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('home_caption', 'Home caption', array('class' => 'control-label')); ?>

                            <?php echo Form::text('home_caption', $homeData->home_caption, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('home_caption')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('home_caption')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('home_tagline', 'Home tag line', array('class' => 'control-label')); ?>

                            <?php echo Form::text('home_tagline', $homeData->home_tagline, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('home_tagline')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('home_tagline')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-6">
                            <?php echo Form::label('home_meta_description', 'Home meta description', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('home_meta_description', $homeData->home_meta_description, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('home_meta_description')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('home_meta_description')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('home_description', 'Home description', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('home_description', $homeData->home_description, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('home_description')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('home_description')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('home_custom_text', 'Custom field', array('class' => 'control-label')); ?>

                            <?php echo Form::text('home_custom_text', $homeData->home_custom_text, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('home_custom_text')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('home_custom_text')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>


                        <div class="form-group col-sm-6">
                            <?php echo Form::label('home_background_image','Home Background image'); ?>

                            <?php echo Form::file('home_background_image', ['id' => 'home_background_image', 'accept' => 'image/*']);; ?>

                            <small><p class="help-block">Max File size: 1MB</p></small>
                        </div>


                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-sm-6">


                                <div class="form-group col-sm-12">
                                    <?php echo Form::label('home_custom_textarea', 'Custom textarea', array('class' => 'control-label')); ?>

                                    <?php echo Form::textarea('home_custom_textarea', $homeData->home_custom_textarea, ['class' => 'form-control textarea']);; ?>

                                    <?php if($errors->has('home_custom_textarea')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('home_custom_textarea')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <img src="<?php echo e(asset('media/theme/'.$homeData->home_background_image)); ?>" style="width: 100%;">
                            </div>


                        </div>
                    </div>

                    <div class="clearfix"></div>
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
<script src="<?php echo e(asset('admin/pages/pageSetting.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>