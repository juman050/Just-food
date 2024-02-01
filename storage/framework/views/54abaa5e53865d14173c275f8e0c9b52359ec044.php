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

                    <?php echo Form::open(['url' => action('Backend\PageSettingController@storeGalleryInfo'), 'method' => 'POST', 'id' => 'storeGalleryInfo', 'class' => '', 'files' => 'true','role'=>'form']); ?>

                    <div class="box-body row">

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('gallery_title', 'Gallery meta title', array('class' => 'control-label')); ?>

                            <?php echo Form::text('gallery_title', $galleryData->gallery_title, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('gallery_title')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('gallery_title')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('gallery_custom_text', 'Custom field', array('class' => 'control-label')); ?>

                            <?php echo Form::text('gallery_custom_text', $galleryData->gallery_custom_text, ['class' => 'form-control']);; ?>

                            <?php if($errors->has('gallery_custom_text')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('gallery_custom_text')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-6">
                            <?php echo Form::label('gallery_meta_description', 'Gallery meta description', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('gallery_meta_description', $galleryData->gallery_meta_description, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('gallery_meta_description')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('gallery_meta_description')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-6">
                            <?php echo Form::label('gallery_custom_textarea', 'Gallery custom textarea', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('gallery_custom_textarea', $galleryData->gallery_custom_textarea, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('gallery_custom_textarea')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('gallery_custom_textarea')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

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